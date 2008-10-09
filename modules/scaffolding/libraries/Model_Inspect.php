<?php
class Model_Inspect_Core
{
	static protected $cache=array();

	protected static function table2model($table)
	{
		return ucfirst(inflector::singular($table)) . '_Model';
	}
	
	public static function byTable($tab)
	{
		return self::byModel(self::table2model($tab));
	}

	public static function byModel($mod)
	{
		if(!array_key_exists($mod, self::$cache))
		{
			self::$cache[$mod] = new Model_Inspector(new $mod());
		}

		return self::$cache[$mod];
	}
}

