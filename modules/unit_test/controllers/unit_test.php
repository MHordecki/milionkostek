<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Unit_Test controller.
 *
 * $Id: unit_test.php 2284 2008-03-11 12:03:50Z Geert $
 *
 * @package    Unit_Test
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Unit_test_Controller extends Controller {

	const ALLOW_PRODUCTION = FALSE;

	public function index()
	{
		// Run tests and show results!
		echo new Unit_Test;
	}

}