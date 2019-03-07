<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Youtube_factory
{
	protected $CI;
	private $master_component_youtube_background_image_path;
	private $master_component_youtube_background_image_path_real;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->master_component_youtube_background_image_path = './uploads/component_youtube_background_image/';
		$this->master_component_youtube_background_image_path_real = rtrim(FCPATH, '/') . '/uploads/component_youtube_background_image/';

		$this->CI->load->model('backend/component/youtube_model');
	}

	public function get_result_arr($data = array())
	{
		$database_result_arr = $this->CI->youtube_model->get_result_arr($data);
		$result_arr = array();

		if (!empty($database_result_arr)) 
		{
			foreach ($database_result_arr as $row) 
			{
				$result_arr[] = array
				(
					'id' => $row['id'],
					'title' => $row['title'],
					'status' => $row['status'],
					'create_datetime' => thai_date_and_time_short(strtotime($row['create_datetime'])),
					'update_datetime' => thai_date_and_time_short(strtotime($row['update_datetime']))
				);
			}
		}

		$response = array
		(
			"draw" => $data['draw'],
			"recordsTotal" => $this->CI->youtube_model->count_all($data),
			"recordsFiltered" => $this->CI->youtube_model->count_filtered($data),
			"data" => $result_arr,
		);

		return $response;
	}

	public function create($language, $data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['component_youtube']['image_background'] = $data['image_background'];
		$data_arr_to_database['component_youtube']['youtube_url'] = $data['youtube_url'];
		$data_arr_to_database['component_youtube']['status'] = $data['status'];
		$data_arr_to_database['component_youtube']['create_datetime'] = $date;
		$data_arr_to_database['component_youtube']['update_datetime'] = $date;

		if (!empty($language)) 
        {
            foreach ($language as $key => $value) 
            {
                if (!empty($data['component_youtube_title_' . $key])) 
                {
                    $data_arr_to_database['component_youtube_title_' . $key] = $data['component_youtube_title_' . $key];
                }
            }
        }

        $trans = $this->CI->youtube_model->insert($language, $data_arr_to_database);
        
        return $trans;
	}

	public function edit($language, $id, $data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['component_youtube']['image_background'] = $data['image_background'];
		$data_arr_to_database['component_youtube']['youtube_url'] = $data['youtube_url'];
		$data_arr_to_database['component_youtube']['status'] = $data['status'];
		$data_arr_to_database['component_youtube']['update_datetime'] = $date;

		if (!empty($language)) 
        {
            foreach ($language as $key => $value) 
            {
                if (!empty($data['component_youtube_title_' . $key])) 
                {
                    $data_arr_to_database['component_youtube_title_' . $key] = $data['component_youtube_title_' . $key];
				}
            }
        }

        $trans = $this->CI->youtube_model->update($language, $id, $data_arr_to_database);
        
        return $trans;
	}

	public function delete($id)
	{
        $trans = $this->CI->youtube_model->delete($id);
        
        return $trans;
	}

	public function get_info($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->youtube_model->get_info_result_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}
}