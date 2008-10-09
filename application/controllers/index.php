<?php defined('SYSPATH') or die('No direct script access.');
class Index_Controller extends Controller 
{
	public function index()
	{
		$news=new News_Model();
		$news=$news->view_recent();
		$this->view['news']=$news;
		$this->renderskel('index',false);
	}

	public function page($pag)
	{
		if(Kohana::find_file('views','static/'.$pag)===false)
			url::redirect();

		$v=new View('static/'.$pag);
		$this->view['content']=Markdown($v->render());
		$this->renderskel();
	}


}
?>
