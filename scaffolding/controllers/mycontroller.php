<?php
class myController extends Controller_Core
{
	public $view;
	public $skel;
	public $auth;
	protected $_auth_required=FALSE;
	protected $_role_required=FALSE;

	function __construct()
	{
		parent::__construct();
		require_once(Kohana::find_file('vendor','Markdown'));
		$this->session = new Session;
		$this->auth=new Auth();
		new Message();
		Message::init($this->session);
		$this->skel=new View('scaffolding/skel');
		$usr=$this->session->get('auth_user',false);
		if($usr !== false)
		{
			$this->view['auth']=TRUE;
			$this->skel->auth=TRUE;
			$this->view['username']=$this->session->get('username',$usr->username);
			$this->skel->username=$this->session->get('username',$usr->username);
			$this->view['userid']=$this->session->get('user_id',$usr->id);
			$this->skel->userid=$this->session->get('user_id',$usr->id);
		}
		else
		{
			$this->view['auth']=FALSE;
			$this->skel->auth=FALSE;
			if($this->_auth_required)
				url::redirect(LOGIN_PAGE);
		}
		if($this->_role_required && $this->view['auth'])
		{
			$roles=$usr->roles;
			foreach($this->_role_required as $role)
			{
				if(!in_array($role,$roles))
				{
					Message::add_flash('Nie masz odpowiednich uprawnien.');
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
