<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Current_project_factory
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model('frontend/project/current_project_model');
    }

    public function get_current_project_title($id = 0, $language = 'th')
    {
        $result_arr = [];

        if (!is_numeric($id) || $id == 0)
        {
            return $result_arr;
        }

        $database_result_arr = $this->CI->current_project_model->get_current_project_title_row_arr($id, $language);
        $result_arr = $database_result_arr;

        return $result_arr;
    }

    public function get_current_project_result_arr($data = [])
    {
        $database_result_arr = $this->CI->current_project_model->get_current_project_result_arr($data);
        $result_arr = [];

        if (!empty($database_result_arr))
        {
            foreach ($database_result_arr as $row)
            {
                $result_arr[] =
                    [
                    'id'                => $row['id'],
                    'image_cover'       => $row['image_cover'],
                    'title'             => $row['title'],
                    'sub_title'         => $row['sub_title'],
                    'short_description' => $row['short_description'],
                    'status'            => $row['status'],
                    'create_datetime'   => $row['create_datetime'],
                    'update_datetime'   => $row['update_datetime'],
                ];
            }
        }

        return $result_arr;
    }

    public function get_current_project_count_all($data = [])
    {
        $records_total = $this->CI->current_project_model->count_all();

        return $records_total;
    }

    public function get_current_project_details_result_arr($id = 0, $language = 'th')
    {
        $result_arr = [];

        if (!is_numeric($id) || $id == 0)
        {
            return $result_arr;
        }

        $database_result_arr = $this->CI->current_project_model->get_current_project_details_result_arr($id, $language);
        $result_arr = $database_result_arr;

        return $result_arr;
    }
}
