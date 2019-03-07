<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_pages_factory
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('backend/banner/banner_pages_model');
	}

	public function create($language, $data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['banner_pages']['home'] = $data['home'];
		$data_arr_to_database['banner_pages']['about_us'] = $data['about_us'];
		$data_arr_to_database['banner_pages']['product_precast'] = $data['product_precast'];
		$data_arr_to_database['banner_pages']['product_prefab'] = $data['product_prefab'];
		$data_arr_to_database['banner_pages']['project_finish'] = $data['project_finish'];
		$data_arr_to_database['banner_pages']['project_current'] = $data['project_current'];
		$data_arr_to_database['banner_pages']['news'] = $data['news'];
		$data_arr_to_database['banner_pages']['contact_us'] = $data['contact_us'];
		$data_arr_to_database['banner_pages']['create_datetime'] = $date;
		$data_arr_to_database['banner_pages']['update_datetime'] = $date;

        $trans = $this->CI->banner_pages_model->insert($language, $data_arr_to_database);
        
        return $trans;
	}

	public function edit($language, $id, $data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['banner_pages']['home'] = $data['home'];
		$data_arr_to_database['banner_pages']['about_us'] = $data['about_us'];
		$data_arr_to_database['banner_pages']['product_precast'] = $data['product_precast'];
		$data_arr_to_database['banner_pages']['product_prefab'] = $data['product_prefab'];
		$data_arr_to_database['banner_pages']['project_finish'] = $data['project_finish'];
		$data_arr_to_database['banner_pages']['project_current'] = $data['project_current'];
		$data_arr_to_database['banner_pages']['news'] = $data['news'];
		$data_arr_to_database['banner_pages']['contact_us'] = $data['contact_us'];
		$data_arr_to_database['banner_pages']['update_datetime'] = $date;

        $trans = $this->CI->banner_pages_model->update($language, $id, $data_arr_to_database);
        
        return $trans;
	}

	public function delete($id)
	{
        $trans = $this->CI->banner_pages_model->delete($id);
        
        return $trans;
	}

	public function get_info($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->banner_pages_model->get_info_result_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}
}