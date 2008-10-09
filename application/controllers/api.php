<?php defined('SYSPATH') or die('No direct script access.');
class Api_Controller extends Controller 
{
	public function submit($code,$category,$value,$prefix = '')
	{
		$db=new Database();
		$res=$db->from('users')->select('id')->where('keycode',$code)->get();

		if(!is_numeric($category) || !is_numeric($value) || (int)$value < 0)
		{
			echo $prefix.'ERROR';
			return;
		}

		if(count($res)==0)
		{
			echo $prefix.'BADCODE';
			return;
		}

		try
		{
			if ( (int) $value == 0)
			{
				echo $prefix.'OK';
				return;
			}

			$uid=$res[0]->id;
			$db=new Database();
			$res=$db->from('users_roles')->where('user_id',$uid)->where('role_id','3')->get();
			if(count($res)==0)
			{
				echo $prefix.'NOACCESS';
				return;
			}


			$db->insert('submissions',array('user_id'=>$uid,'category_id'=>$category,'solved'=>$value));
		$db->query('UPDATE milion_users SET solved=solved+? WHERE id=?',array($value,$uid));
		}
		catch(Exception $ex)
		{
			echo $prefix.'ERROR';
			return;
		}	

		echo $prefix.'OK';
		return;

	}

	public function categories()
	{
		$db=new Database();
		$res=$db->from('categorys')->get();

		header("Content-Type: text/plain;charset=UTF-8");

		foreach($res as $result)
		{
			echo "$result->id;$result->cube;$result->method\n";
		}

	}

}
?>
