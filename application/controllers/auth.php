<?php defined('SYSPATH') or die('No direct script access.');
class Auth_Controller extends Controller 
{
	public function login()
	{
		$f=new Forge(NULL,'Panel logowania');
		$f->input('username')->label('Nazwa uzytkownika')->rules('required');
		$f->password('password')->label('Haslo')->rules('required');
		$f->submit('Zaloguj sie');
		if($f->validate())
		{
			$usr=new User_Model($f->username->value);
			if($this->auth->login($usr,$f->password->value,TRUE))
			{
				Message::add_flash('Zalogowano.');
				url::redirect('');
				//$this->session->add('username',$usr->username);
			}
			else
			{
				Message::add('Błędne dane użytkownika.');
			}
		}

		$this->view['content']=$f->render();
		$this->renderskel();
	}

	public function logout()
	{
		Message::add_flash('Wylogowano');
		$this->auth->logout();
		url::redirect('auth/login');
	}

	public function create()
	{
		$f=new Forge(NULL,'Zakładanie nowego użytkownika');

		$f->input('username')->label('Nazwa użytkownika')->rules('required|length[4,20]')->callback(array(&$this,'create_usernameexistscallback'));
		$f->input('name')->label('Imię i nazwisko')->rules('required');
		$f->input('email')->label('Adres email')->rules('required');
		$passw1=$f->password('password1')->label('Hasło')->rules('required');
		$f->password('password2')->label('Powtórz hasło')->rules('required')->matches($passw1);
		$f->submit('Zarejestruj się');

		if($f->validate())
		{
			$user=new User_Model();
			$user->username=$f->username->value;
			$user->password=$f->password1->value;
			$user->email=$f->email->value;
			$user->name=$f->name->value;
			$user->name=$f->name->value;
			try
			{
			if($user->save())
			{
				Message::add_flash('Użytkownik '.$f->username->value.' został stworzony. Teraz możesz się zalogować.');
				$user->add_role('login');
				$user->add_role('submit');
			url::redirect('auth/login');

			} else
			Message::add('Nastąpił błąd. Spróbuj ponownie');
			}
			catch(Exception $e)
			{
				Message::add('Nastąpił błąd. Spróbuj ponownie');
			}

		}


		$this->view['content']=$f->render();
		$this->renderskel();
	}

	public function create_usernameexistscallback($input)
	{
		$user=new User_Model();
		if($user->username_exists($input->value))
		{
			$input->add_error('Zła nazwa użytkownika','Taki użytkownik już istnieje');
		}
	}


}
?>
