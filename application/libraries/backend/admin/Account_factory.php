<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_factory
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('backend/admin/account_model');
	}

	public function get_result_arr($data = array())
	{
		$database_result_arr = $this->CI->account_model->get_result_arr($data);
		$result_arr = array();

		if (!empty($database_result_arr)) 
		{
			foreach ($database_result_arr as $row) 
			{
				$result_arr[] = array
				(
					'id' => $row['id'],
					'email' => $row['email'],
					'username' => $row['username'],
					'status' => $row['status'],
					'create_datetime' => thai_date_and_time_short(strtotime($row['create_datetime'])),
                    'update_datetime' => thai_date_and_time_short(strtotime($row['update_datetime'])),
				);
			}
		}

		$response = array
		(
			"draw" => $data['draw'],
			"recordsTotal" => $this->CI->account_model->count_all($data),
			"recordsFiltered" => $this->CI->account_model->count_filtered($data),
			"data" => $result_arr,
		);

		return $response;
	}

	public function create($data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$salt = $this->generate_salt();
		$endcode_password = $this->encode_password($data['password'], $salt);

		$data_arr_to_database['admin_account']['email'] = $data['email'];
		$data_arr_to_database['admin_account']['username'] = $data['username'];
		$data_arr_to_database['admin_account']['password'] = $endcode_password;
		$data_arr_to_database['admin_account']['salt'] = $salt;
		$data_arr_to_database['admin_account']['first_name'] = $data['first_name'];
		$data_arr_to_database['admin_account']['last_name'] = $data['last_name'];
		$data_arr_to_database['admin_account']['mobile'] = $data['mobile'];
		$data_arr_to_database['admin_account']['status'] = $data['status'];
		$data_arr_to_database['admin_account']['create_datetime'] = $date;
		$data_arr_to_database['admin_account']['update_datetime'] = $date;

        $trans = $this->CI->account_model->insert($data_arr_to_database);
        
        return $trans;
	}

	public function edit($id, $data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		if (!empty($data['password'])) 
		{
			$salt = $this->generate_salt();
			$endcode_password = $this->encode_password($data['password'], $salt);

			$data_arr_to_database['admin_account']['password'] = $endcode_password;
			$data_arr_to_database['admin_account']['salt'] = $salt;
		}
		
		$data_arr_to_database['admin_account']['first_name'] = $data['first_name'];
		$data_arr_to_database['admin_account']['last_name'] = $data['last_name'];
		$data_arr_to_database['admin_account']['mobile'] = $data['mobile'];
		$data_arr_to_database['admin_account']['status'] = $data['status'];
		$data_arr_to_database['admin_account']['update_datetime'] = $date;

        $trans = $this->CI->account_model->update($id, $data_arr_to_database);
        
        return $trans;
	}

	public function delete($id)
	{
        $trans = $this->CI->account_model->delete($id);
        
        return $trans;
	}

	public function get_info($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->account_model->get_info_result_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}

	public function get_info_in_array($id = array())
	{
		$result_arr = array();

		if (empty($id)) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->account_model->get_info_in_array_result_arr($id);

		if (!empty($database_result_arr)) 
		{
			foreach ($database_result_arr as $row) 
			{
				$result_arr[] = array
				(
					'id' => $row['id'],
					'email' => $row['email'],
					'username' => $row['username'],
					'createdate' => $row['createdate'],
					'updatedate' => $row['updatedate']
				);
			}
		}

		return $result_arr;
	}

	private function generate_salt()
	{
		$salt = random_string('alnum', 32);

		return $salt;
	}

	private function encode_password($password, $salt)
	{
		$_salt = $salt;
		$_password = $password;

		return password_hash($_password . $_salt, PASSWORD_DEFAULT);
	}

	private function decode_password($password, $salt, $hash)
	{
		$_password = $password;
		$_salt = $salt;
		$_hash = $hash;

		if (password_verify($_password . $_salt, $_hash)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
}