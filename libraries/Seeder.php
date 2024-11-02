<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder {

	protected $CI;
	protected $_seeder_enabled = FALSE;
	protected $_seeder_path = NULL;

	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		$this->CI->lang->load('seeder');

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
			show_error($this->CI->lang->line('seeder_not_enabled'));
		}

		$this->_seeder_path !== '' OR $this->_seeder_path = APPPATH.'seeders/';
		$this->_seeder_path = rtrim($this->_seeder_path, '/').'/';
	}

	public function call($seeder_name)
	{
		$file = $this->_seeder_path.$seeder_name.'.php';

		if (file_exists($file) === FALSE)
		{
			show_error(sprintf($this->CI->lang->line('seeder_file_doesnt_exist'), $seeder_name));
		}
		else
		{
			include_once($file);
		}

		if (class_exists($seeder_name, FALSE) === FALSE)
		{
			show_error(sprintf($this->CI->lang->line('seeder_class_doesnt_exist'), $seeder_name));
		}
		else
		{
			$seeder = new $seeder_name();
		}

		if (method_exists($seeder_name, 'run') === FALSE)
		{
			show_error(sprintf($this->CI->lang->line('seeder_missing_run_method'), $seeder_name));
		}
		else
		{
			$seeder->run();
		}
	}
}
