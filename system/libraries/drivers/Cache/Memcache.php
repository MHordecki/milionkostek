<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Memcache-based Cache driver.
 *
 * $Id: Memcache.php 2430 2008-04-05 11:50:54Z Geert $
 *
 * @package    Cache
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Cache_Memcache_Driver implements Cache_Driver {

	// Cache backend object and flags
	protected $backend;
	protected $flags;

	public function __construct()
	{
		if ( ! extension_loaded('memcache'))
			throw new Kohana_Exception('cache.extension_not_loaded', 'memcache');

		$this->backend = new Memcache;
		$this->flags = Config::item('cache_memcache.compression') ? MEMCACHE_COMPRESSED : 0;

		foreach (Config::item('cache_memcache.servers') as $server)
		{
			// Make sure all required keys are set
			$server += array('host' => '127.0.0.1', 'port' => 11211, 'persistent' => FALSE);

			// Add the server to the pool
			$this->backend->addServer($server['host'], $server['port'], (bool) $server['persistent'])
				or Log::add('error', 'Cache: Connection failed: '.$server['host']);
		}
	}

	public function find($tag)
	{
		return FALSE;
	}

	public function get($id)
	{
		return $this->backend->get($id);
	}

	public function set($id, $data, $tags, $lifetime)
	{
		count($tags) and Log::add('error', 'Cache: Tags are unsupported by the memcache driver');

		// Memcache driver expects unix timestamp
		if ($lifetime !== 0)
		{
			$lifetime += time();
		}

		return $this->backend->set($id, $data, $this->flags, $lifetime);
	}

	public function delete($id, $tag = FALSE)
	{
		if ($id === TRUE)
			return $this->backend->flush();

		if ($tag == FALSE)
			return $this->backend->delete($id);

		return TRUE;
	}

	public function delete_expired()
	{
		return TRUE;
	}

} // End Cache Memcache Driver