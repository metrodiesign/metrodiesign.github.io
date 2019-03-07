<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_factory
{
	protected $CI;
	private $path_banner_image;
    private $path_real_banner_image;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('frontend/banner/banner_model');

		$this->path_banner_image = '/uploads/banner/';
        $this->path_real_banner_image = rtrim(FCPATH, '/') . '/uploads/banner/';
	}

	public function get_result_arr($data = array())
	{
		$database_result_arr = $this->CI->banner_model->get_result_arr($data);
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
					'create_datetime' => $row['create_datetime'],
					'update_datetime' => $row['update_datetime']
				);
			}
		}

		$response = array
		(
			"draw" => $data['draw'],
			"recordsTotal" => $this->CI->banner_model->count_all(),
			"recordsFiltered" => $this->CI->banner_model->count_filtered($data),
			"data" => $result_arr,
		);

		return $response;
	}

	public function get_info($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->banner_model->get_info_result_arr($id);

		if (!empty($database_result_arr['banner_image'])) {
			foreach ($database_result_arr['banner_image'] as $key => $value) {
				if (!empty($value['image']) && file_exists($this->path_real_banner_image . $value['image'])) {
					if ($value['size'] == 'desktop') {
						$result_arr['desktop'][] = $this->path_banner_image . $value['image'];
					}

					if ($value['size'] == 'tablet') {
						$result_arr['tablet'][] = $this->path_banner_image . $value['image'];
					}

					if ($value['size'] == 'mobile') {
						$result_arr['mobile'][] = $this->path_banner_image . $value['image'];
					}
				}
			}
		}

		return $result_arr;
	}

	public function get_banner_pages($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->banner_model->get_banner_pages_row_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}
}