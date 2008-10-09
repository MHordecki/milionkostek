<?php defined('SYSPATH') or die('No direct script access.');
class Admin_Controller extends Controller 
{
	protected $_auth_required=true;
	protected $_role_required=array('admin');

	public function index()
	{
		$this->renderskel('admin/index');
	}

	public function posts()
	{
		$s=new Scaffolding(new News_Model());
		$this->view['content']=$s->scaffold(func_get_args());
		$this->renderskel();
	}

	public function problems()
	{
		$s=new Scaffolding(new Problem_Model());
		$this->view['content']=$s->scaffold(func_get_args());
		$this->renderskel();
	}

	public function problemsets()
	{
		$s=new Scaffolding(new Problemset_Model());
		$this->view['content']=$s->scaffold(func_get_args());
		$this->renderskel();
	}

	public function users()
	{
		$s=new Scaffolding(new User_Model());
		$this->view['content']=$s->scaffold(func_get_args());
		$this->renderskel();
	}

	public function roles()
	{
		$s=new Scaffolding(new Role_Model());
		$this->view['content']=$s->scaffold(func_get_args());
		$this->renderskel();
	}

	public function pages()
	{
		$pages=preg_grep('/.*static\/.*/',Kohana::list_files('views',true));
		$this->view['pages']=$pages;
		$this->renderskel('admin/pages');
	}

	public function page($id)
	{
		$pages=preg_grep('/.*static\/.*/',Kohana::list_files('views',true));
		$page=@$pages[$id];
		if($page==NULL)
		{
			Message::add_flash('This page does not exist.');
			url::redirect('/admin/pages');
		}

		$f=new Forge('','Edycja strony statycznej');
		$f->const('tytul')->label('Strona')->value(substr($page,strpos($page,'static')));
		$f->textarea('tresc')->label('Treść')->value(file_get_contents($page))->rows(20)->cols(55);
		$f->submit('Wyślij');

		if($f->validate())
		{
			file_put_contents($page,$f->tresc->value);
			Message::add('Treść została zmieniona');
		}
		$prefix=html::anchor('/admin/pages','Wróć').'.<br /><br />';
		$this->view['content']=$prefix.$f->render();
		$this->renderskel();
	}


}
?>
