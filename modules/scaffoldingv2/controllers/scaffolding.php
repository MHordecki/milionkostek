<?php
require_once 'mycontroller.php';

class Scaffolding_Controller extends myController
{

	////OPTIONS FOR RESTRICTED ACCESS
	
	//protected $_auth_required=true;
	//protected $_role_required=array('admin');

	function __construct()
	{
		parent::__construct();
		$this->scanModels();
	}

	public function index()
	{
		$this->renderskel('scaffolding/index');
	}

	public function about()
	{
		$this->renderskel('scaffolding/about');
	}

	public function manual()
	{
		$this->renderskel('scaffolding/manual');
	}

	public function model()
	{
		$args=func_get_args();
		if(class_exists($args[0]))
		{
			$classname=$args[0];
			$s=new Scaffolding(new $classname());
			$this->view['content']=$s->scaffold(array_slice($args,1));
		} else
		{
			$this->view['content']='<h1>Error</h2><p>This model does not exist.</p>';
		}
		$this->renderskel();
	}

	public function media()
	{
		if (isset($this->profiler)) $this->profiler->disable();

		// Get the filename
		$file = implode('/', $this->uri->segment_array(1));
		$ext = strrchr($file, '.');

		if ($ext !== FALSE)
		{
			$file = substr($file, 0, -strlen($ext));
			$ext = substr($ext, 1);
		}

		// Disable auto-rendering
		$this->auto_render = FALSE;

		try
		{
			// Attempt to display the output
			echo new View('scaffolding/'.$file, NULL, $ext);
		}
		catch (Kohana_Exception $e)
		{
			Event::run('system.404');
		}
	}

	protected function scanModels()
	{
		$files=Kohana::list_files('models');
		foreach($files as $file)
		{
			include_once $file;
		}

		$classes=array_diff(preg_grep('/^(.*)_Model$/',get_declared_classes()),array('Form_Model','User_Token_Model','User_Edit_Model'));

		$this->models=$classes;
		$this->skel->models=$classes;
	}


}
