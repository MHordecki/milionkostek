<?php defined('SYSPATH') or die('No direct script access.');

class Post_Model extends Model {

	protected $_key_field='title';
	protected $belongs_to=array('user');
	protected $_fields=array('user_id' => array('name'=>'author'));

	public function view_recent()
	{
		return $this->db
			->from('posts')
			->select('posts.*, users.username as author')
			->join('users',array('users.id' => 'posts.user_id'))
			->limit(10)
			->orderby('created','DESC')
			->get()
			->result();
	}

}
