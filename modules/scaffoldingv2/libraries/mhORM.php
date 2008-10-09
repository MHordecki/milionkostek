<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Advanced ORM class.
 *
 * $Id$
 *
 * @author     Michal Hordecki
 * @copyright  (c) 2008 Michal Hordecki
 * @url    http://mhordecki.wordpress.com/
 */

class mhORM
{
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
	
	static public function fromORM() {}

	static public function fromDB() {}

	public function getMeta() {}

	public function all() {}

	public function 

}
