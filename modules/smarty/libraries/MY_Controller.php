<?php defined('SYSPATH') or die('No direct script access.');

class Controller extends Controller_Core {

	function __construct()
	{
		parent::__construct();
	
		if (Config::item('smarty.integration') == TRUE)
		{
			$this->MY_Smarty = new MY_Smarty;
		}
	}
	
	public function _kohana_load_view($template, $vars)
	{
		if ($template == '')
			return;

		if (substr(strrchr($template, '.'), 1) === Config::item('smarty.templates_ext')) 
		{
			// Assign variables to the template
			if (is_array($vars) AND count($vars) > 0) 
			{
				foreach ($vars AS $key => $val)
				{
					$this->MY_Smarty->assign($key, $val);
				}
			}

			// Send Kohana::instance to all templates
			$this->MY_Smarty->assign('this', $this);

			// Fetch the output
			$output = $this->MY_Smarty->fetch($template);
			
		} 
		else 
		{
			$output = parent::_kohana_load_view($template, $vars);
		}

		return $output;
	}
}
