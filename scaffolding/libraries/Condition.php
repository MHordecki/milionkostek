<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Provides extended abstraction for building SQL or/and where statements.
 *
 * $Id$
 *
 * @author     Michal Hordecki
 * @copyright  (c) 2008 Michal Hordecki
 * @url    http://mhordecki.wordpress.com/
 */

class Condition
{
	protected $type;
	protected $content;
	protected $db;

	public static function condition(&$db, $key=false, $val=NULL)
	{
		return new Condition($db,$key,$val);
	}

	public function __construct(&$db,$key=false,$val=NULL)
	{
		$this->type = false;
		$this->content = array();
		$this->db = &$db;
		if($key)
			$this->add($key,$val);
	}

	public function add($key,$val=NULL,$op='=')
	{
		if($val!==NULL)
			$key=array($key,$val,$op);
		if(!is_array($key))
			$key=array($key);

		$this->content[]=$key;

		return $this;
	}

	public function and_($key, $val, $op='=')
	{
		$this->type = 'AND';
		$this->add($key, $val, $op);

		return $this;
	}

	public function or_($key,$val,$op='=')
	{
		$this->type = 'OR';
		$this->add($key, $val, $op);

		return $this;
	}

	public function count()
	{
		return count($this->content);
	}

	public function process($escape = TRUE)
	{
		$ret=array();
		foreach($this->content as $val)
		{
			if(count($val)==1) //embedded condition
			{
				$ret[]='('.$val[0]->process().')';
			} else
			{
				if($escape)
					$ret[]=$val[0].' '.(array_key_exists(2,$val) ? $val[2] : '=').' '.$this->db->escape($val[1]);
				else
					$ret[]=$val[0].' '.(array_key_exists(2,$val) ? $val[2] : '=').' '.$val[1];
			}
		}

		return implode(' '.($this->type ? $this->type : 'AND').' ',$ret);
	}
}

