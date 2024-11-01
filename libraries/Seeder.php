<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder {

	protected $CI;
	protected $_seeder_enabled = FALSE;
	protected $_seeder_path = NULL;

	public function __construct($config = array())
	{
		$this->CI =& get_instance();

		if (empty($config))
		{
			$this->CI->config->load('seeder', TRUE);
			$config = $this->CI->config->item('seeder');
		}

		foreach ($config as $key => $val)
		{
			$this->{'_'.$key} = $val;
		}

		if ($this->_seeder_enabled !== TRUE)
		{
			show_error('Seeders has been loaded but is disabled or set up incorrectly.');
		}
	}

	public function call($seeder_name)
	{
		require_once($this->_seeder_path.$seeder_name.'.php');

		$seeder = new $seeder_name();
		$seeder->run();
	}
}
