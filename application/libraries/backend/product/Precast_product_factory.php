<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Precast_product_factory
{
	protected $CI;
	private $master_precast_product_image_cover_path;
	private $master_precast_product_image_gallery_path;
	private $master_precast_product_image_cover_path_real;
	private $master_precast_product_image_gallery_path_real;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->master_precast_product_image_cover_path = './uploads/precast_product_cover/';
		$this->master_precast_product_image_gallery_path = './uploads/precast_product_gallery/';
		$this->master_precast_product_image_cover_path_real = rtrim(FCPATH, '/') . '/uploads/precast_product_cover/';
		$this->master_precast_product_image_gallery_path_real = rtrim(FCPATH, '/') . '/uploads/precast_product_gallery/';

		$this->CI->load->model('backend/product/precast_product_model');
	}

	public function get_result_arr($data = array())
	{
		$database_result_arr = $this->CI->precast_product_model->get_result_arr($data);
		$result_arr = array();

		if (!empty($database_result_arr)) 
		{
			foreach ($database_result_arr as $row) 
			{
				$image_cover_arr = array();
				$image_cover_path = $this->master_precast_product_image_cover_path_real . $row['image_cover'];

				if (file_exists($image_cover_path)) 
				{
					$image_cover_arr[] = $this->master_precast_product_image_cover_path . $row['image_cover'];
				}

				$result_arr[] = array
				(
					'id' => $row['id'],
					'title' => $row['title'],
					'image_cover_arr' => $image_cover_arr,
					'status' => $row['status'],
					'create_datetime' => thai_date_and_time_short(strtotime($row['create_datetime'])),
					'update_datetime' => thai_date_and_time_short(strtotime($row['update_datetime']))
				);
			}
		}

		$response = array
		(
			"draw" => $data['draw'],
			"recordsTotal" => $this->CI->precast_product_model->count_all($data),
			"recordsFiltered" => $this->CI->precast_product_model->count_filtered($data),
			"data" => $result_arr,
		);

		return $response;
	}

	public function create($language, $data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['precast_product']['image_cover'] = $data['image_cover'];
		$data_arr_to_database['precast_product']['status'] = $data['status'];
		$data_arr_to_database['precast_product']['create_datetime'] = $date;
		$data_arr_to_database['precast_product']['update_datetime'] = $date;

		if (!empty($language)) 
        {
            foreach ($language as $key => $value) 
            {
                if (!empty($data['precast_product_title_' . $key])) 
                {
                    $data_arr_to_database['precast_product_title_' . $key] = $data['precast_product_title_' . $key];
                }

                if (!empty($data['precast_product_desc_' . $key])) 
                {
                    $data_arr_to_database['precast_product_desc_' . $key] = $data['precast_product_desc_' . $key];
                }
            }
        }

        $data_arr_to_database['precast_product_gallery_desktop'] = array();

		if (!empty($data['precast_product_gallery_desktop'])) 
		{
			$data_arr_to_database['precast_product_gallery_desktop'] = $data['precast_product_gallery_desktop'];
		}

        $trans = $this->CI->precast_product_model->insert($language, $data_arr_to_database);
        
        return $trans;
	}

	public function edit($language, $id, $data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['precast_product']['image_cover'] = $data['image_cover'];
		$data_arr_to_database['precast_product']['status'] = $data['status'];
		$data_arr_to_database['precast_product']['update_datetime'] = $date;

		if (!empty($language)) 
        {
            foreach ($language as $key => $value) 
            {
                if (!empty($data['precast_product_title_' . $key])) 
                {
                    $data_arr_to_database['precast_product_title_' . $key] = $data['precast_product_title_' . $key];
				}
				
				if (!empty($data['precast_product_desc_' . $key])) 
                {
                    $data_arr_to_database['precast_product_desc_' . $key] = $data['precast_product_desc_' . $key];
                }
            }
        }

        $data_arr_to_database['precast_product_gallery_desktop'] = array();

		if (!empty($data['precast_product_gallery_desktop'])) 
		{
			$data_arr_to_database['precast_product_gallery_desktop'] = $data['precast_product_gallery_desktop'];
		}

        $trans = $this->CI->precast_product_model->update($language, $id, $data_arr_to_database);
        
        return $trans;
	}

	public function delete($id)
	{
        $trans = $this->CI->precast_product_model->delete($id);
        
        return $trans;
	}

	public function get_info($id = 0)
	{
		$result_arr = array();

		if (!is_numeric($id) || $id == 0) 
		{
			return $result_arr;
		}

		$database_result_arr = $this->CI->precast_product_model->get_info_result_arr($id);
		$result_arr = $database_result_arr;

		return $result_arr;
	}
}