<?php

class Scaffoldingv2_Controller extends Controller
{

	public function index()
	{
		echo '<pre>';
		$d = new Database();
		$q = new Query($d);
		$q->type('delete')
			->fields(array('xD'=>"foo baria! xd.xda "))
			->fields(array('solved' => 13))
			->where(Condition::condition($d,'id',3))
			->table('categorys');
		echo $q->query()."\n";
	}

}
