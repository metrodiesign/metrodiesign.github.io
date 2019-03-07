<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Home_about_factory
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model('frontend/home/home_about_model');
    }

    public function get_home_about_details_result_arr($id = 0, $language = 'th')
    {
        $result_arr = [];

        if (!is_numeric($id) || $id == 0)
        {
            return $result_arr;
        }

        $database_result_arr = $this->CI->home_about_model->get_home_about_details_result_arr($id, $language);
        $result_arr = $database_result_arr;

        return $result_arr;
    }
}
