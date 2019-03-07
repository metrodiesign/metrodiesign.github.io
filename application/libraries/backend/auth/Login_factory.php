<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_factory
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->library('session');
		$this->CI->load->model('backend/auth/login_model');
	}

	public function login($username, $password)
	{
		$result_arr = array();

		if (empty($username) || empty($password)) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->login_model->get_info_result_arr_by_username($username);

		if (!empty($database_result_arr['admin_account'])) 
		{
			if ($this->decode_password($password, $database_result_arr['admin_account']['salt'], $database_result_arr['admin_account']['password'])) 
			{
				unset($database_result_arr['admin_account']['username']);
				unset($database_result_arr['admin_account']['salt']);
				unset($database_result_arr['admin_account']['password']);
				unset($database_result_arr['admin_account']['forgot_password_code']);
				unset($database_result_arr['admin_account']['forgot_password_expire']);
				unset($database_result_arr['admin_account']['create_datetime']);
				unset($database_result_arr['admin_account']['update_datetime']);
				
				$result_arr = $database_result_arr['admin_account'];

				$this->CI->session->unset_userdata('admin_account');
				$this->CI->session->set_userdata('admin_account', $result_arr);
			}
		}

		return $result_arr;
	}

	private function generate_salt()
	{
		return random_string('alnum', 32);
	}

	private function encode_password()
	{
		$salt = 'HpMqtVrSEagxdCJzOZW4w8N23Yl9UDKo';
		$username = 'admin@admin.com';
		$password = 'p@ssw0rdc0ny';

		echo password_hash($password . $salt, PASSWORD_DEFAULT);
	}

	private function decode_password($password, $salt, $hash)
	{
		if (password_verify($password . $salt, $hash)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
}