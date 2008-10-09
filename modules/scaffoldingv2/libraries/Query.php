<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Provides extended abstraction for building SQL queries.
 *
 * $Id$
 *
 * @author     Michal Hordecki
 * @copyright  (c) 2008 Michal Hordecki
 * @url    http://mhordecki.wordpress.com/
 */

class Query_Core 
{
	protected $type; /// Query type
	protected $fields;
	protected $groupby;
	protected $orderby;
	protected $orderby_order;
	protected $where;
	protected $db;
	protected $table;
	protected $join;

	protected $offset;
	protected $limit;

	protected $last_query;

	protected $prefix;

	static public function query(&$db, $type = 'SELECT')
	{
		return new Query($db, $type);
	}

	public function condition($key=false, $val=NULL)
	{
		return Condition::condition($this->db, $key, $val);
	}


	public function __construct(&$db, $type = 'SELECT')
	{
		$this->db=&$db;
		$this->reset();
		$this->type($type);

		$this->prefix = Config::item('database.default.table_prefix');
	}

	public function reset()
	{
		$this->fields = array();
		$this->groupby = array();
		$this->orderby = array();
		$this->orderby_order = 'ASC';
		$this->join = array();
		$this->table = array();
		$this->offset = false;
		$this->limit = false;
		$this->type();
		$this->last_query='';
		$this->where=new Condition($this->db);
	}

	public function type($type = 'SELECT')
	{
		$type = strtoupper($type);
		if (!in_array($type, array('SELECT', 'DELETE', 'UPDATE')))
			$type = 'SELECT';

		$this->type = $type;

		return $this;
	}

	public function table($args)
	{
		if (!is_array($args)) $args = array($args);

		foreach($args as $key=>$arg)
			$this->table[]=$this->prefix.$arg;
		
		return $this;
	}

	public function fields($args)
	{
		if (!is_array($args)) $args = array($args);

		if($this->type == 'UPDATE')
		{
			foreach($args as $key => $arg)
				$this->fields[$this->escape_prefix($key, $this->prefix)] = $arg;
		}
		else
			foreach($args as $key => $val)
			{
				if(is_int($key))
					$this->fields[] = $this->escape_prefix($val, $this->prefix);
				else
					$this->fields[$key] = $this->escape_prefix($val, $this->prefix);
			}

		return $this;
	}

	public function groupby($arg)
	{
		$this->groupby = $this->escape_prefix($arg, $this->prefix);

		return $this;
	}

	public function orderby($args,$order='asc')
	{
		if (!is_array($args)) $args = array($args);

		$order = strtoupper ($order);

		foreach($args as $arg)
		{
			$this->orderby[] = $this->escape_prefix($arg, $this->prefix);
		}

		if(in_array($order, array('ASC','DESC')))
		{
			$this->orderby_order = $order;
		}

		return $this;
	}

	public function where($key,$val=NULL)
	{
		$this->where->add($key,$val);

		return $this;
	}

	public function join($table, $keys, $type = 'LEFT')
	{
		$type = strtoupper($type);

		if (!in_array($type, array('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER')))
			$type = 'LEFT';

		$this->join[] = array($this->prefix.$table, $keys, $type);

		return $this;
	}

	public function limit($limit)
	{
		$this->limit = $limit;

		return $this;
	}
	public function offset($offset)
	{
		$this->offset = $offset;

		return $this;
	}

	public function execute($object=TRUE)
	{
		return $this->db->query($this->process())->result($object);
	}

	public function process()
	{
		$ret=array($this->type);

		if($this->type == 'SELECT')
		{
			$tmp=array();

			if($this->fields)
			{
				foreach($this->fields as $key=>$val)
				{
					if(is_string($key))
						$tmp[] = $val.' as '.$key;
					else
						$tmp[] = $val;
				}

				$ret[] = implode(', ',$tmp);
			}
			else
				$ret[] = '*';

			$ret[] = 'FROM '.implode(', ',$this->table);

			foreach($this->join as $join)
			{
				$ret[] = $join[2].' JOIN';
				$ret[] = $join[0];
				$ret[] = 'ON';
				$ret[] = $this->escape_prefix($join[1]->process(FALSE), $this->prefix);
			}
		}
		else if($this->type == 'DELETE')
		{
			$ret[] = 'FROM '.implode(', ',$this->table);
		}
		else if($this->type == 'UPDATE')
		{
			$ret[] = 'TABLE '.implode(', ',$this->table);
			$ret[] = 'SET';
			$tmp = array();
			foreach($this->fields as $key=>$val)
					$tmp[] = $key.'='.$this->db->escape($val);

			$ret[] = implode(', ',$tmp);
		}

		if($this->where->count() > 0)

		{
			$ret[] = 'WHERE';
			$ret[] = $this->escape_prefix($this->where->process(), $this->prefix);
		}

		if($this->type == 'SELECT')
		{
			if($this->groupby)
				$ret[] = 'GROUP BY '.$this->groupby;
	
			if($this->orderby)
			{
				$ret[] = 'ORDER BY';
				$ret[] = implode(', ',$this->orderby);
				$ret[] = $this->orderby_order;
			}
		}

		if($this->limit)
			$ret[]='LIMIT '.$this->limit;

		if($this->offset)
			$ret[]='OFFSET '.$this->offset;

		return $this->last_query = implode(' ',$ret);
		
	}

	public function last_query()
	{
		return $this->last_query;
	}

	/**
	 * @todo: Not escaping in string literals, i.e concat(X, 'no.escape', Y)
	 */
	protected function escape_prefix($str, $prefix='')
	{
		if (empty($prefix)) return $str;

		return preg_replace('/(\w+)\.(\w+)/',preg_quote($prefix).'${1}.${2}',$str);
	}


}
