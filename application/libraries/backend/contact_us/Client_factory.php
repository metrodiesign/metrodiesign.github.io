<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_factory
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('backend/contact_us/client_model');
	}

	public function get_result_arr($data = array())
	{
		$database_result_arr = $this->CI->client_model->get_result_arr($data);
		$result_arr = array();

		if (!empty($database_result_arr)) 
		{
			foreach ($database_result_arr as $row) 
			{
				$result_arr[] = array
				(
					'id' => $row['id'],
					'name' => $row['name'],
					'email' => $row['email'],
					'subject' => $row['subject'],
					'message' => $row['message'],
					'create_datetime' => $row['create_datetime']
				);
			}
		}

		$response = array
		(
			"draw" => $data['draw'],
			"recordsTotal" => $this->CI->client_model->count_all(),
			"recordsFiltered" => $this->CI->client_model->count_filtered($data),
			"data" => $result_arr,
		);

		return $response;
	}

	public function delete($id)
	{
        $trans = $this->CI->client_model->delete($id);
        
        return $trans;
	}

	public function get_info($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->client_model->get_info_result_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}
}