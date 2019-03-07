<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_factory
{
	protected $CI;
	private $path_component_download_cover_image;
    private $path_real_component_download_cover_image;
    private $path_component_download_file;
    private $path_real_component_download_file;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('frontend/component/download_model');

		$this->path_component_download_cover_image = '/uploads/component_download_cover_image/';
        $this->path_real_component_download_cover_image = rtrim(FCPATH, '/') . '/uploads/component_download_cover_image/';
        $this->path_component_download_file = '/uploads/component_download_file/';
        $this->path_real_component_download_file = rtrim(FCPATH, '/') . '/uploads/component_download_file/';
	}

	public function get_result_arr($data = array())
	{
		$database_result_arr = $this->CI->download_model->get_result_arr($data);
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
			"recordsTotal" => $this->CI->download_model->count_all(),
			"recordsFiltered" => $this->CI->download_model->count_filtered($data),
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

		$database_result_arr = $this->CI->download_model->get_info_result_arr($id);

		if (!empty($database_result_arr)) {
			$result_arr = $database_result_arr;

			if (file_exists($this->path_real_component_download_cover_image . $result_arr['download']['image_cover'])) 
            {
                $result_arr['download']['image_cover'] = $this->path_component_download_cover_image . $result_arr['download']['image_cover'];
            }

            if (file_exists($this->path_real_component_download_file . $result_arr['download']['file_url'])) 
            {
                $result_arr['download']['file_url'] = $this->path_component_download_file . $result_arr['download']['file_url'];
            }
		}

		return $result_arr;
	}

	public function get_download_pages($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->download_model->get_download_pages_row_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}
}