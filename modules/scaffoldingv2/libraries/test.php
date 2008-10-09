<?php

class X
{
	public $pub;
	protected $prot;
	private $priv;

	public function __construct()
	{
		$this->pub = 'A';
		$this->prot = 'P';
		$this->priv = 'X';
	}
}

$a = new X();
$a = array_keys((array) $a);
foreach($a as $a)
{
	var_dump($a);
	echo ord($a[0])."\n";
}
