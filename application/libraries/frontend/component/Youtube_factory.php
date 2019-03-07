<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Youtube_factory
{
	protected $CI;
	private $path_component_youtube_background_image;
    private $path_real_component_youtube_background_image;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->helper('youtube');

		$this->CI->load->model('frontend/component/youtube_model');

		$this->path_component_youtube_background_image = '/uploads/component_youtube_background_image/';
        $this->path_real_component_youtube_background_image = rtrim(FCPATH, '/') . '/uploads/component_youtube_background_image/';
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
					'create_datetime' => $row['create_datetime'],
					'update_datetime' => $row['update_datetime']
				);
			}
		}

		$response = array
		(
			"draw" => $data['draw'],
			"recordsTotal" => $this->CI->youtube_model->count_all(),
			"recordsFiltered" => $this->CI->youtube_model->count_filtered($data),
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

		$database_result_arr = $this->CI->youtube_model->get_info_result_arr($id);

		if (!empty($database_result_arr)) {
			$result_arr = $database_result_arr;

			if (file_exists($this->path_real_component_youtube_background_image . $result_arr['youtube']['image_background'])) 
            {
                $result_arr['youtube']['image_background'] = $this->path_component_youtube_background_image . $result_arr['youtube']['image_background'];
            }

            $result_arr['youtube']['youtube_url'] = get_youtube_id_from_url($result_arr['youtube']['youtube_url']);
		}

		return $result_arr;
	}

	public function get_youtube_pages($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->youtube_model->get_youtube_pages_row_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}
}