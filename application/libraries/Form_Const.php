<?php defined('SYSPATH') or die('No direct script access.');
class Form_Const_Core extends Form_Input {

	protected $data=array(
		'value' => '',
	);

	public function html()
	{
		return $this->data['value'];
	}

}
