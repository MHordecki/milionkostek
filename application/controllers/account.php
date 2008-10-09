<?php defined('SYSPATH') or die('No direct script access.');
class Account_Controller extends Controller 
{
	protected $_auth_required=TRUE;

	public function index()
	{
		$this->renderskel('account');
	}
	
	public function password()
	{
		$form=new Forge(NULL,'Zmiana hasła');

		$form->password('oldpass')->label('Aktualne hasło')->rules('required');
		$passw1=$form->password('passw')->label('Nowe hasło')->rules('required');
		$form->password('password_check')->label('Nowe hasło (powtórz)')->rules('required')->matches($passw1);
		$form->submit('Zatwierdź zmiany');

		if($form->validate())
		{
			$auth = isset(Kohana::instance()->auth) ? Kohana::instance()->auth : new Auth();
			$usr=new User_Model($this->view['userid']);

			if($auth->hash_password($form->oldpass->value,$this->find_salt($usr->password))==$usr->password)
			{
				$usr->password=$form->passw->value;
				$usr->save();
				Message::add_flash('Hasło zostało zmienione.');
				url::redirect('/account');

			}
			else
			{
				Message::add('Twoje stare hasło jest błędne.');
			}
		}

		$this->view['content']=$form->render();
		$this->renderskel();
	}

	protected function find_salt($password)
	{
		$salt = '';

		$saltpatt = preg_split('/, ?/', Config::item('auth.salt_pattern'));

		foreach($saltpatt as $i => $offset)
		{
			// Find salt characters... take a good long look..
			$salt .= substr($password, $offset + $i, 1);
		}

		return $salt;
	}

	public function submit()
	{
		$db=new Database();
		$res=$db->from('categorys')
			->get();

		$opts=array();
		foreach($res as $result)
		{
			$opts[$result->id]=$result->cube.' :: '.$result->method;
		}


		$form=new Forge(NULL,'Wysłanie zgłoszenia');


		$form->dropdown('category')->options($opts);
		$form->input('submission')->rules('required');

		$form->submit('Wyślij');

		if($form->validate())
		{
			if(!in_array('submit',$this->session->get('auth_user')->roles))
			{
				Message::add_flash('Nie masz odpowiednich uprawnień.');
				url::redirect('/account/');
			}

			try
			{
				$db=new Database();
				$db->insert('submissions',array('user_id'=>$this->view['userid'],'category_id'=>$form->category->value,'solved'=>$form->submission->value));
				$db->query('UPDATE milion_users SET solved=solved+? WHERE id=?',array($form->submission->value,$this->view['userid']));
			}
			catch(Exception $ex)
			{
				Message::add_flash('Wystąpił błąd. Spróbuj ponownie.');
				url::redirect('/account/submit');
			}
				Message::add_flash('Zgłoszenie zostało wysłane.');
				url::redirect('/account/');

			
		}

		$this->view['content']=$form->render();
		$this->renderskel();
	}

	public function code()
	{
		$usr=new User_Model($this->view['userid']);
		srand(time(0));
		if($usr->keycode=='')
		{
			//Generowanie kodu
			while(1)
			{
				$hash=hash('sha1',$usr->username.substr($usr->password,0,8).rand(0,50000));
				$hash=substr(strtoupper($hash),0,16);
				$db=new Database();
				if(count($db->from('users')->where('keycode',$hash)->get())==0) break;
			}

			$usr->keycode=substr($hash,0,16);
			$usr->save();
		}
		$this->view['code']=$usr->keycode;
		$this->renderskel('code');
	}



}
?>
