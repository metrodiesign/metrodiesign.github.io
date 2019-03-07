<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Province_factory
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('backend/global/province_model');
	}

	public function get_result_arr($data = array())
	{
		$database_result_arr = $this->CI->province_model->get_result_arr($data);
		$result_arr = array();

		if (!empty($database_result_arr)) 
		{
			foreach ($database_result_arr as $row) 
			{
				$result_arr[] = array
				(
					'province_id' => $row['PROVINCE_ID'],
					'province_code' => $row['PROVINCE_CODE'],
					'province_name' => $row['PROVINCE_NAME'],
					'province_name_eng' => $row['PROVINCE_NAME_ENG'],
					'geo_id' => $row['GEO_ID']
				);
			}
		}

		$response = array
		(
			"draw" => $data['draw'],
			"recordsTotal" => $this->CI->province_model->count_all($data),
			"recordsFiltered" => $this->CI->province_model->count_filtered($data),
			"data" => $result_arr,
		);

		return $response;
	}

	public function get_info($province_id = 0)
	{
		$result_arr = array();

		if (!is_numeric($province_id) || $province_id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->province_model->get_info_result_arr($province_id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}

	public function get_info_in_array($province_id = array())
	{
		$result_arr = array();

		if (empty($province_id)) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->province_model->get_info_in_array_result_arr($province_id);

		if (!empty($database_result_arr)) 
		{
			foreach ($database_result_arr as $row) 
			{
				$result_arr[] = array
				(
					'province_id' => $row['PROVINCE_ID'],
					'province_code' => $row['PROVINCE_CODE'],
					'province_name' => $row['PROVINCE_NAME'],
					'province_name_eng' => $row['PROVINCE_NAME_ENG'],
					'geo_id' => $row['GEO_ID']
				);
			}
		}

		return $result_arr;
	}
}