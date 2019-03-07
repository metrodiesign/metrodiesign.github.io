<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_factory
{
	protected $CI;
	private $master_banner_path;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->master_banner_path = './uploads/banner/';

		$this->CI->load->model('backend/banner/banner_model');
	}

	public function get_result_arr($data = array())
	{
		$database_result_arr = $this->CI->banner_model->get_result_arr($data);
		$result_arr = array();

		if (!empty($database_result_arr)) 
		{
			foreach ($database_result_arr as $row) 
			{
				$banner_arr = array();
				$banner_temps = array();
				$banner_temps = $this->CI->banner_model->get_image_by_banner_id_result_arr($row['id']);

				if (!empty($banner_temps)) 
				{
					foreach ($banner_temps as $row_banner) 
					{
						$banner_path = $this->master_banner_path . $row_banner['image'];
						$banner_size = @getimagesize($banner_path);

						if (is_array($banner_size)) 
						{
							$banner_arr[] = '/uploads/banner/' . $row_banner['image'];
						}
					}
				}

				$result_arr[] = array
				(
					'id' => $row['id'],
					'title' => $row['title'],
					'status' => $row['status'],
					'banner_arr' => $banner_arr,
					'create_datetime' => thai_date_and_time_short(strtotime($row['create_datetime'])),
					'update_datetime' => thai_date_and_time_short(strtotime($row['update_datetime']))
				);
			}
		}

		$response = array
		(
			"draw" => $data['draw'],
			"recordsTotal" => $this->CI->banner_model->count_all($data),
			"recordsFiltered" => $this->CI->banner_model->count_filtered($data),
			"data" => $result_arr,
		);

		return $response;
	}

	public function create($data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['banner']['title'] = $data['title'];
		$data_arr_to_database['banner']['status'] = $data['status'];
		$data_arr_to_database['banner']['create_datetime'] = $date;
		$data_arr_to_database['banner']['update_datetime'] = $date;

		$data_arr_to_database['banner_image_desktop'] = array();

		if (!empty($data['banner_image_desktop'])) 
		{
			$data_arr_to_database['banner_image_desktop'] = $data['banner_image_desktop'];
		}

		$data_arr_to_database['banner_image_tablet'] = array();

		if (!empty($data['banner_image_tablet'])) 
		{
			$data_arr_to_database['banner_image_tablet'] = $data['banner_image_tablet'];
		}

		$data_arr_to_database['banner_image_mobile'] = array();

		if (!empty($data['banner_image_mobile'])) 
		{
			$data_arr_to_database['banner_image_mobile'] = $data['banner_image_mobile'];
		}

        $trans = $this->CI->banner_model->insert($data_arr_to_database);
        
        return $trans;
	}

	public function edit($id, $data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['banner']['title'] = $data['title'];
		$data_arr_to_database['banner']['status'] = $data['status'];
		$data_arr_to_database['banner']['update_datetime'] = $date;

		$data_arr_to_database['banner_image_desktop'] = array();

		if (!empty($data['banner_image_desktop'])) 
		{
			$data_arr_to_database['banner_image_desktop'] = $data['banner_image_desktop'];
		}

		$data_arr_to_database['banner_image_tablet'] = array();

		if (!empty($data['banner_image_tablet'])) 
		{
			$data_arr_to_database['banner_image_tablet'] = $data['banner_image_tablet'];
		}

		$data_arr_to_database['banner_image_mobile'] = array();

		if (!empty($data['banner_image_mobile'])) 
		{
			$data_arr_to_database['banner_image_mobile'] = $data['banner_image_mobile'];
		}

        $trans = $this->CI->banner_model->update($id, $data_arr_to_database);
        
        return $trans;
	}

	public function delete($id)
	{
        $trans = $this->CI->banner_model->delete($id);
        
        return $trans;
	}

	public function get_info($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->banner_model->get_info_result_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}
}