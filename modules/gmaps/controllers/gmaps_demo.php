<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Gmaps module demo controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * $Id: gmaps_demo.php 2317 2008-03-18 01:36:41Z Shadowhand $
 *
 * @package    Gmaps
 * @author     Woody Gilk
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Gmaps_Demo_Controller extends Controller {

	// Do not allow to run in production
	const ALLOW_PRODUCTION = FALSE;

	public function index()
	{
		$this->db = Database::instance('mysql://root:r00tdb@localhost/azmap');

		// Create a new Gmap
		$map = new Gmap('map');

		// Set the map center point
		$map->center(0, 0, 1)->controls('large');

		// Add a new marker
		$map->add_marker(44.9801, -93.2519, '<strong>Minneapolis, MN</strong><p>Hello world!</p>');

		View::factory('gmaps/api_demo')->set('map', $map->render())->render(TRUE);
	}

	public function azmap()
	{
		$this->db = Database::instance('mysql://root:r00tdb@localhost/azmap');

		// Create a new Gmap
		$map = new Gmap('map', array
		(
			'ScrollWheelZoom' => TRUE,
		));

		// Set the map center point
		$map->center(0, 35, 2)->controls('large');

		// Set marker locations
		foreach (ORM::factory('location')->find_all() as $location)
		{
			// Add a new marker
			$map->add_marker($location->lat, $location->lon,
				// Get the info window HTML
				View::factory('gmaps/info_window')->bind('location', $location)->render());
		}

		header('Content-type: text/javascript');
		echo $map->render();
	}

	public function admin()
	{
		$valid = ! empty($_POST);

		$_POST = Validation::factory($_POST)
			->pre_filter('trim')
			->add_rules('title', 'required', 'length[4,32]')
			->add_rules('description', 'required', 'length[4,127]')
			->add_rules('link', 'length[6,127]', 'valid::url')
			->add_rules('address', 'required', 'length[4,127]')
			->add_callbacks('address', array($this, '_admin_check_address'));

		if ($_POST->validate())
		{
			// Create a new location
			$location = ORM::factory('location');

			//
			foreach ($_POST->as_array() as $key => $val)
			{
				$location->$key = $val;
			}

			echo Kohana::debug($_POST->as_array());
		}

		if ($errors = $_POST->errors())
		{
			foreach ($errors as $input => $rule)
			{
				// Add the errors
				$_POST->message($input, Kohana::lang("gmaps.form.$input"));
			}
		}

		View::factory('gmaps/admin')->render(TRUE);
	}

	public function _admin_check_address(Validation $array, $input)
	{
		if ($array[$input] == '')
			return;

		// Fetch the lat and lon via Gmap
		list ($lat, $lon) = Gmap::address_to_ll($array[$input]);

		if ($lat === NULL OR $lon === NULL)
		{
			// Add an error
			$array->add_error($input, 'address');
		}
		else
		{
			// Set the latitude and longitude
			$_POST['lat'] = $lat;
			$_POST['lon'] = $lon;
		}
	}

	public function jquery()
	{
		View::factory('gmaps/jquery')->render(TRUE);
	}

	public function xml()
	{
		$this->db = Database::instance('mysql://root:r00tdb@localhost/azmap');

		// Get all locations
		$locations = ORM::factory('location')->find_all();

		// Create the XML container
		$xml = new SimpleXMLElement('<gmap></gmap>');

		foreach ($locations as $location)
		{
			// Create a new mark
			$node = $xml->addChild('marker');

			// Set the latitutde and longitude
			$node->addAttribute('lon', $location->lon);
			$node->addAttribute('lat', $location->lat);

			$node->html = View::factory('gmaps/xml')->bind('location', $location)->render();

			foreach ($location->as_array() as $key => $val)
			{
				// Skip the ID
				if ($key === 'id') continue;

				// Add the data to the XML
				$node->$key = $val;
			}
		}

		header('Content-Type: text/xml');
		echo $xml->asXML();
	}

} // End Google Map Controller