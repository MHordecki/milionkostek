<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Calendar creation library.
 *
 * $Id: Calendar.php 2827 2008-06-11 19:45:54Z Shadowhand $
 *
 * @package    Calendar
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Calendar_Core extends Event_Subject {

	// Month and year to use for calendaring
	protected $month;
	protected $year;

	// Start the calendar on Sunday by default
	public $week_start = 0;

	// Observed data
	protected $observed_data;

	/**
	 * Create a new Calendar instance. A month and year can be specified.
	 * By default, the current month and year are used.
	 *
	 * @param   integer  month number
	 * @param   integer  year number
	 * @param   boolean  start weeks on monday
	 * @return  object
	 */
	public static function factory($month = NULL, $year = NULL, $start_monday = NULL)
	{
		return new Calendar($month, $year, $start_monday);
	}

	/**
	 * Create a new Calendar instance. A month and year can be specified.
	 * By default, the current month and year are used.
	 *
	 * @param   integer  month number
	 * @param   integer  year number
	 * @param   boolean  start weeks on monday
	 * @return  void
	 */
	public function __construct($month = NULL, $year = NULL, $start_monday = NULL)
	{
		empty($month) and $month = date('n'); // Current month
		empty($year)  and $year  = date('Y'); // Current year

		// Set the month and year
		$this->month = (int) $month;
		$this->year  = (int) $year;

		if ($start_monday === TRUE)
		{
			// Some locales start the week on Monday, not Sunday.
			$this->week_start = 1;
		}
	}

	/**
	 * Allows fetching the current month and year.
	 *
	 * @param   string  key to get
	 * @return  mixed
	 */
	public function __get($key)
	{
		if ($key === 'month' OR $key === 'year')
		{
			return $this->$key;
		}
	}

	/**
	 * Calendar_Event factory method.
	 *
	 * @param   string  unique name for the event
	 * @return  object  Calendar_Event
	 */
	public function event($name = NULL)
	{
		return new Calendar_Event($this);
	}

	/**
	 * Calendar_Event factory method.
	 *
	 * @chainable
	 * @param   string  standard event type
	 * @return  object
	 */
	public function standard($name)
	{
		switch ($name)
		{
			case 'today':
				// Add an event for the current day
				$this->attach($this->event()->condition('timestamp', strtotime('today'))->add_class('today'));
			break;
			case 'prev-next':
				// Add an event for padding days
				$this->attach($this->event()->condition('current', FALSE)->add_class('prev-next'));
			break;
			case 'holidays':
				// Base event
				$event = $this->event()->condition('current', TRUE)->add_class('holiday');

				// Attach New Years
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 1)->condition('day', 1));

				// Attach Valentine's Day
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 2)->condition('day', 14));

				// Attach St. Patrick's Day
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 3)->condition('day', 17));

				// Attach Easter
				$holiday = clone $event;
				$this->attach($holiday->condition('easter', TRUE));

				// Attach Memorial Day
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 5)->condition('day_of_week', 1)->condition('last_occurrence', TRUE));

				// Attach Independance Day
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 7)->condition('day', 4));

				// Attach Labor Day
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 9)->condition('day_of_week', 1)->condition('occurrence', 1));

				// Attach Halloween
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 10)->condition('day', 31));

				// Attach Thanksgiving
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 11)->condition('day_of_week', 4)->condition('occurrence', 4));

				// Attach Christmas
				$holiday = clone $event;
				$this->attach($holiday->condition('month', 12)->condition('day', 25));
			break;
			case 'weekends':
				// Weekend events
				$this->attach($this->event()->condition('weekend', TRUE)->add_class('weekend'));
			break;
		}

		return $this;
	}

	/**
	 * Returns an array for use with a view. The array contains an array for
	 * each week. Each week contains 7 arrays, with a day number and status:
	 * TRUE if the day is in the month, FALSE if it is padding.
	 *
	 * @return  array
	 */
	public function weeks()
	{
		// First day of the month as a timestamp
		$first = mktime(1, 0, 0, $this->month, 1, $this->year);

		// Total number of days in this month
		$total = (int) date('t', $first);

		// Last day of the month as a timestamp
		$last  = mktime(1, 0, 0, $this->month, $total, $this->year);

		// Make the month and week empty arrays
		$month = $week = array();

		// Number of days added. When this reaches 7, start a new month
		$days = 0;
		$week_number = 1;

		if (($w = (int) date('w', $first)) > $this->week_start)
		{
			// Number of days in the previous month
			$n = (int) date('t', mktime(1, 0, 0, $this->month - 1, 1, $this->year));

			// i = number of day, t = number of days to pad
			for ($i = $n - $w + $this->week_start + 1, $t = $w - $this->week_start; $t > 0; $t--, $i++)
			{
				// Notify the listeners
				$this->notify(array($this->month - 1, $i, $this->year, $week_number, FALSE));

				// Add previous month padding days
				$week[] = array($i, FALSE, $this->observed_data);
				$days++;
			}
		}

		// i = number of day
		for ($i = 1; $i <= $total; $i++)
		{
			if ($days % 7 === 0)
			{
				// Start a new week
				$month[] = $week;
				$week = array();

				$week_number++;
			}

			// Notify the listeners
			$this->notify(array($this->month, $i, $this->year, $week_number, TRUE));

			// Add days to this month
			$week[] = array($i, TRUE, $this->observed_data);
			$days++;
		}

		if (($w = (int) date('w', $last) - $this->week_start) < 6 )
		{
			// i = number of day, t = number of days to pad
			for ($i = 1, $t = 6 - $w; $t > 0; $t--, $i++)
			{
				// Notify the listeners
				$this->notify(array($this->month + 1, $i, $this->year, $week_number, FALSE));

				// Add next month padding days
				$week[] = array($i, FALSE, $this->observed_data);
			}
		}

		if ( ! empty($week))
		{
			// Append the remaining days
			$month[] = $week;
		}

		return $month;
	}

	/**
	 * Adds new data from an observer. All event data contains and array of CSS
	 * classes and an array of output messages.
	 *
	 * @param   array  observer data.
	 * @return  void
	 */
	public function add_data(array $data)
	{
		// Add new classes
		$this->observed_data['classes'] += $data['classes'];

		if ( ! empty($data['output']))
		{
			// Only add output if it's not empty
			$this->observed_data['output'][] = $data['output'];
		}
	}

	/**
	 * Resets the observed data and sends a notify to all attached events.
	 *
	 * @param   array  UNIX timestamp
	 * @return  void
	 */
	public function notify($data)
	{
		// Reset observed data
		$this->observed_data = array
		(
			'classes' => array(),
			'output' => array(),
		);

		// Send a notify
		parent::notify($data);
	}

	/**
	 * Convert the calendar to HTML using the kohana_calendar view.
	 *
	 * @return  string
	 */
	public function render()
	{
		$view =  new View('kohana_calendar', array
		(
			'month'  => $this->month,
			'year'   => $this->year,
			'weeks'  => $this->weeks(),
		));

		return $view->render();
	}

	/**
	 * Magically convert this object to a string, the rendered calendar.
	 *
	 * @return  string
	 */
	public function __toString()
	{
		return $this->render();
	}

} // End Calendar