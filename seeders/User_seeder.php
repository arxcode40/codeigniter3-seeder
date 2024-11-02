<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_seeder extends Seeder {

	public function __construct()
	{
		parent::__construct();
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
