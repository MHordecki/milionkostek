<?php
class myController extends Controller
{
	public $view;
	public $skel;
	public $auth;
	protected $_auth_required=FALSE;
	protected $_role_required=FALSE;

	function __construct()
	{
		$this->session = new Session;
		$this->auth=new Auth();
		Message::init($this->session);
		parent::__construct();
		$this->skel=new View('scaffolding/skel');

		if($this->auth->auto_login())
		{
			$this->view['auth']=TRUE;
			$this->skel->auth=TRUE;
			$this->view['username']=$this->session->get('username','x');
			$this->skel->username=$this->session->get('username','x');
			$this->view['userid']=$this->session->get('user_id','x');
			$this->skel->userid=$this->session->get('user_id','x');
		}
		else
		{
			$this->view['auth']=FALSE;
			$this->skel->auth=FALSE;
			if($this->_auth_required)
				url::redirect('scaffolding/login');
		}
		if($this->_role_required && $this->view['auth'])
		{
			$roles=$this->session->get('roles');
			foreach($this->_role_required as $role)
			{
				if(!in_array($role,$roles))
				{
					Message::add_flash("You don't have proper permissions.");
					url::redirect('');
				}
			}
		}
	}
public	function renderskel($v='',$markdown=TRUE)
{
	if($v=='')
	{
		$this->skel->content=$this->view['content'];
		$this->skel->render(TRUE);
		return;
	}
	$content=new View($v,$this->view);
	if($markdown)
		$this->skel->content=Markdown($content->render());
	else
		$this->skel->content=$content->render();
	$this->skel->render(TRUE);
}
}
