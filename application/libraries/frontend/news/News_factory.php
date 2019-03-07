<?php
defined('BASEPATH') || exit('No direct script access allowed');

class News_factory
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model('frontend/news/news_model');
    }

    public function get_news_title($id = 0, $language = 'th')
    {
        $result_arr = [];

        if (!is_numeric($id) || $id == 0)
        {
            return $result_arr;
        }

        $database_result_arr = $this->CI->news_model->get_news_title_row_arr($id, $language);
        $result_arr = $database_result_arr;

        return $result_arr;
    }

    public function get_news_result_arr($data = [])
    {
        $database_result_arr = $this->CI->news_model->get_news_result_arr($data);
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

    public function get_news_count_all($data = [])
    {
        $records_total = $this->CI->news_model->count_all();

        return $records_total;
    }

    public function get_news_details_result_arr($id = 0, $language = 'th')
    {
        $result_arr = [];

        if (!is_numeric($id) || $id == 0)
        {
            return $result_arr;
        }

        $database_result_arr = $this->CI->news_model->get_news_details_result_arr($id, $language);
        $result_arr = $database_result_arr;

        return $result_arr;
    }
}
