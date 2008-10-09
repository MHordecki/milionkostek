<?php


class html extends html_Core
{
	public static function spage($page,$title)
	{
		return self::anchor('/index/page/'.$page,$title);
	}
}
