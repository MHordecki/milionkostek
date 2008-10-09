<?php


class Message_Core
{
	public static $messages = array();
	public static $session;

	static public function init(&$ses)
	{
		self::$session=&$ses;
	}

	static public function add($text)
	{
		self::$messages[]=$text;
	}

	public static function draw()
	{
		$ret='';
		$flash=self::$session->get('message_flash',array());
		foreach(array_merge(self::$messages,$flash) as $mess)
		{
			$ret.='<p style="background-color:#EEE;">'.$mess.'</p>';
		}
		return $ret;
	}

	public static function add_flash($text)
	{
		if(is_array($text))
			self::$session->set_flash('message_flash',$text);
		else
			self::$session->set_flash('message_flash',array($text));
	}
}

