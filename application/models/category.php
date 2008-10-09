<?php

class Category_Model
{
	protected $cache=false;
	protected $opts;
	protected $ext_opts;

		protected $_key_field = "concat(categories.cube, ' :: ',categories.method)";

	public function getCats()
	{
		if(!$this->cache)
		{
		$db=new Database();
		$res=$db->from('categories')
			->get();		
		$this->opts[]='Wszystkie';
		$optcount=0;
		$cubes=array();
			foreach($res as $result)
			{
				$optcount++;
				$this->opts[$result->cube][$optcount]=$result->method;
				$cubes[$result->cube][]=$result->id;
				$this->ext_opts[$optcount]=array($result->id);
			}

		foreach(array_keys($cubes) as $cube)
		{
			$optcount++;
			$this->opts[$cube][$optcount]='Wszystkie';
			$this->ext_opts[$optcount]=$cubes[$cube];
		}


			$this->cache=true;
		}

		return $this->opts;


	}

	public function getCatsIdFromFormId($id)
	{
		$this->getCats();
		if($id==0) return false;
		return $this->ext_opts[$id];
	}

	public function getNameFromFormId($id)
	{
		if($id==0) return 'Wszystkie';
		foreach($this->opts as $key=>$cube)
		{
			if(!is_array($cube)) continue;
			if(array_key_exists($id,$cube))
				return $key.' :: '.$cube[$id];
		}
	}
}
