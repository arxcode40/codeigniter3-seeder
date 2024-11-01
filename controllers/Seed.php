<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller {

	public function index()
	{
		$this->load->library('seeder');

		$this->seeder->call('User_seeder');
	}
}
