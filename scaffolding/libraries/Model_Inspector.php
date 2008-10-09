<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Inspects Model classes and gathers info about fields, relationships etc.
 * It provides compatibility with both standard Model and Kohana 2.1 ORM objects.
 * 
 * @warning Model_Inspector should not be instantiated by user. Use Model_Inspect class instead.
 * @package Scaffolding
 * @author Michal Hordecki
 * @license GNU LGPL
 */
class Model_Inspector_Core
{
	protected $model;
	protected $db;

	protected $props=array();
	protected $meta=array();
	protected $inspected=false;

	/**
	 * Loads model.
	 *
	 * @param $model Model to be analyzed. It should be an instance of a given model.
	 */
	function __construct(&$model)
	{
		$this->model=&$model;
		$this->db=new Database();
	}

	protected function model2table($model)
	{
		return inflector::plural(strtolower(substr(get_class($this->model),0,strpos(get_class($this->model),'_Model'))));
	}

	protected function table2model($table)
	{
		return ucfirst(inflector::singular($table)).'_Model';
	}

	protected function relation2table($table)
	{
//		Log::add('error','r2t: '.$table.'  -> '.inflector::plural(substr(get_class($this->model),0,strpos(get_class($this->model),'_id'))));
		return inflector::plural(substr(get_class($this->model),0,strpos(get_class($this->model),'_id')));
	}

	protected function table2relation($table)
	{
//		Log::add('error','t2r: '.$table.'  -> '.inflector::singular($table).'_id');
		return inflector::singular($table).'_id';
	}

	/**
	 * Uses PHP hack (bug?) to gather protected properties from Model class, such as $belongs_to. Hope PHP authors won't fix it.
	 */
	protected function devour_property($object, $property)
	{
		if(!is_array($object))
			$object = (array) $object;

		$prot_prefix = chr(0).'*'.chr(0); // prefix for protected members
		$priv_prefix = chr(0).'X'.chr(0); // prefix for private members

		if(array_key_exists($property,$object))
			return $object[$property];

		if(array_key_exists($prot_prefix.$property,$object))
			return $object[$prot_prefix.$property];

		if(array_key_exists($priv_prefix.$property,$object))
			return $object[$priv_prefix.$property];

		return false;
	}

	protected function devour_properties($class)
	{
		$arr = (array)$class;
		$ret = array();
		if($tmp = $this->devour_property($arr, '_key_field'))
			$ret['key_field']=$tmp;
		if($tmp = $this->devour_property($arr, '_fields'))
			$ret['fields']=$tmp;

		if($tmp = $this->devour_property($arr, 'belongs_to'))
		{
			$ret['belongs_to']=$tmp;
			foreach($ret['belongs_to'] as &$key)
			{
				$key = inflector::plural($key);
			}
		}
		if($tmp = $this->devour_property($arr, 'has_many'))
			$ret['has_many']=$tmp;
		if($tmp = $this->devour_property($arr, 'has_and_belongs_to_many'))
			$ret['has_and_belongs_to_many']=$tmp;

		return $ret;
	}

	public function getTableName()
	{
		 return $this->model2table($this->model);
	}

	/**
	 * Gathers metadata from database about given model.
	 */
	protected function get_metadata()
	{
		$tablename=$this->model2table($this->model);
		$fielddata=$this->db->field_data($tablename);
		$ret=array();
		foreach($fielddata as $field)
		{
			$type=array('',-1);
			$delim=strpos($field->Type,'(');
			if ($delim!== false)
			{
				$type[0]=substr($field->Type,0,$delim);
				$type[1]=(int)substr($field->Type,$delim+1,-1);
			}
			else
				$type[0]=$field->Type;
			unset($delim);

			$ret[$field->Field]=array(
				$field->Field,
				strtolower($type[0]),
				$type[1],
			);
		}

		return $ret;

	}

	/**
	 * Method: getKeyField
	 * Returns metadata about key field.
	 * When key field isn't specified, returns metadata about id field.
	 */
	public function getKeyField()
	{
		if(!$this->inspected) $this->inspect();
		$tablename=$this->model2table($this->model);
		if(array_key_exists('key_field',$this->props))
		{
			if(array_key_exists($this->props['key_field'],$this->meta))
			{
				$ret = $this->meta[$this->props['key_field']];
				$ret[0] = $tablename.'.'.$ret[0];
				return $ret;
			}
			else
				return array($this->props['key_field'],-1,'name' => 'keyfield');

		}
		else
		{
			$ret = $this->meta['id'];
			$ret[0] = $tablename.'.'.$ret[0];
			return $ret;
		}
	}

	/**
	 * Inspects model and fills metadata.
	 *
	 * @return Metadata array.
	 */
	public function inspect()
	{
		if($this->inspected) return $this->meta;
		$this->props=$this->devour_properties($this->model);
		$this->meta=$this->get_metadata();

		if(array_key_exists('belongs_to',$this->props))
		{
			foreach($this->props['belongs_to'] as $prop)
			{
				$col=$this->table2relation($prop);
				$this->meta[$col][1]='foreign';
				$this->meta[$col][2]=-1;
				$this->meta[$col]['foreign']=$prop;
			}
		}

		if(array_key_exists('has_many',$this->props))
		{
			foreach($this->props['has_many'] as $prop)
			{
				$col='_'.$prop;
				$this->meta[$col][0]=$col;
				$this->meta[$col][1]='relationship_has_many';
				$this->meta[$col][2]=-1;
				$this->meta[$col]['has_many']=$prop;
				$this->meta[$col]['options']['hide_edit']=true;
			}
		}

		if(array_key_exists('has_and_belongs_to_many',$this->props))
		{
			foreach($this->props['has_and_belongs_to_many'] as $prop)
			{
				$col='_'.$prop;
				$this->meta[$col][0]=$col;
				$this->meta[$col][1]='relationship_has_and_belongs_to_many';
				$this->meta[$col][2]=-1;
				$this->meta[$col]['has_and_belongs_to_many']=$prop;
				$this->meta[$col]['options']['hide_edit']=true;
			}
		}

		if(array_key_exists('fields',$this->props))
		{
			foreach($this->meta as $key => $val)
			{
				if(array_key_exists($key,$this->props['fields']))
				{
					if(array_key_exists('name',$this->props['fields'][$key]))
						$this->meta[$key]['name']=$this->props['fields'][$key]['name'];
					else
						$this->meta[$key]['name']=$key;
					
					if(array_key_exists('dont_inspect',$this->props['fields'][$key]))
					{
						unset($this->meta[$key]);
						continue;
					}

					$this->meta[$key]['options']=$this->props['fields'][$key];
				}
				else
					$this->meta[$key]['name']=$key;
			}
		 } else
			foreach($this->meta as $key => $val)
			{
					$this->meta[$key]['name']=$key;
			}

		$this->inspected=true;
		return $this->meta;
	}

	/**
	 * Gets result array (like Kohana's Database get()->result(false)) with fields of given model.
	 * 
	 * @param $db Database object. It can be restricted by user (with where(), for example).
	 */
	public function getList(Query $qry,$object=false)
	{
		$tablename=$this->model2table($this->model);
		$qry->table($tablename);

		foreach($this->meta as $col)
		{
			switch($col[1])
			{
			default:
				$qry->fields(array($tablename.'.'.$col[0]));
			break;
			case 'foreign':
				$in=Model_Inspect::byTable($col['foreign']);
				$in->inspect();
				$keyfield=$in->getKeyField();
				$qry->fields(array($col[0] =>$keyfield[0],
					'_inspector_'.$col[0] => $tablename.'.'.$col[0]
				));
				$qry->join($col['foreign'],$qry->condition($col['foreign'].'.id',$tablename.'.'.$col[0]));
			break;
			case 'relationship_has_many':

				$qry->join($col['has_many'],$qry->condition($col['has_many'].'.'.$this->table2relation($tablename),$tablename.'.id'));
				$qry->fields(array($col[0] => 'count(distinct '.$col['has_many'].'.id)'));
				$qry->groupby($tablename.'.id');

			break;
			case 'relationship_has_and_belongs_to_many':
				$tabnam=$tablename.'_'.$col['has_and_belongs_to_many'];
				$qry->join($tabnam,$qry->condition($tabnam.'.'.$this->table2relation($tablename),$tablename.'.id'));
				$qry->fields(array($col[0]=>'count(distinct '.$tabnam.'.'.$this->table2relation($col['has_and_belongs_to_many']).')'));
				$qry->groupby($tablename.'.id');

			break;
			}
		}

		return	$qry->execute(false);

	}

	public function GetKeyList(Query $qry)
	{
		$tablename=$this->model2table($this->model);
		$qry->table($tablename);
		$keyfield=$this->getKeyField();
		$qry->fields(array('_key'=>$keyfield[0],$tablename.'.id'));
		return $qry->execute(false);
	}

	public function getOne(Query $qr,$object=false)
	{
		$keyfield = $this->getKeyField();
		$qr->limit(1);
		$qr->fields(array('_keyfield' => $keyfield[0]));
		return	$this->getList($qr);
	}

	public function getRelated(Query $qry,$id,$relation)
	{
		$tablename=$this->model2table($this->model);
		$tabrel=$this->table2relation($tablename);
		$col=$this->meta['_'.$relation];

		if($col[1]=='relationship_has_and_belongs_to_many')
		{
			$in=Model_Inspect::byTable($relation);
			$relkey=$in->getKeyField();
			$qry->fields(array('name' => $relkey[0],$relation.'.id'));
			$qry->table($tablename.'_'.$relation);
			$qry->where($tablename.'_'.$relation.'.'.$tabrel,$id);
			$qry->join($relation,$qry->condition($relation.'.id',$tablename.'_'.$relation.'.'.$this->table2relation($relation)));
		}
		else
		{
			$in=Model_Inspect::byTable($relation);
			$relkey=$in->getKeyField();
			$qry->fields(array('id'=>$relation.'.id','name' => $relkey[0]));
			$qry->table($relation);
			$qry->where($relation.'.'.$tabrel,$id);
		}
			return $qry->execute(false);

	}


} // End Model_Inspector
