<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Auth driver interface.
 *
 * $Id: Auth.php 2482 2008-04-12 16:48:50Z Shadowhand $
 *
 * @package    Auth
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
interface Auth_Driver {

	/**
	 * Logs a user in.
	 *
	 * @param   string   username
	 * @param   string   password
	 * @param   boolean  enable auto-login
	 * @return  boolean
	 */
	public function login($username, $password, $remember);

	/**
	 * Forces a user to be logged in, without specifying a password.
	 *
	 * @param   mixed    username
	 * @return  boolean
	 */
	public function force_login($username);

	/**
	 * Logs a user in, based on stored credentials, typically cookies.
	 *
	 * @return  boolean
	 */
	public function auto_login();

	/**
	 * Log a user out.
	 *
	 * @param   boolean   complete destroy the session
	 * @return  boolean
	 */
	public function logout($destroy);

	/**
	 * Checks if a session is active.
	 *
	 * @param   string    role name
	 * @return  boolean
	 */
	public function logged_in($role);

	/**
	 * Get the stored password for a username.
	 *
	 * @param   mixed   username
	 * @return  string
	 */
	public function password($username);

} // End Auth_Driver Interface