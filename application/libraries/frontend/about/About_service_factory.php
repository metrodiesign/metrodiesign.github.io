<?php
defined('BASEPATH') || exit('No direct script access allowed');

class About_service_factory
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model('frontend/about/about_service_model');
    }

    public function get_about_service_details_result_arr($id = 0, $language = 'th')
    {
        $result_arr = [];

        if (!is_numeric($id) || $id == 0)
        {
            return $result_arr;
        }

        $database_result_arr = $this->CI->about_service_model->get_about_service_details_result_arr($id, $language);
        $result_arr = $database_result_arr;

        return $result_arr;
    }
}
