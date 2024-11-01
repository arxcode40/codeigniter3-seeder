<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_seeder {

	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function run()
	{
		$data = array(
			'username' => 'admin',
			'password' => 'admin',
			'role' => 'admin'
		);

		$this->CI->db->insert('users', $data);
	}
}
