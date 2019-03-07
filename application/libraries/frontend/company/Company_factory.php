<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Company_factory
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model('frontend/company/company_model');
    }

    public function get_info($id = 0, $language = 'th')
    {
        $result_arr = [];

        if (!is_numeric($id) || $id == 0)
        {
            return $result_arr;
        }

        $database_result_arr = $this->CI->company_model->get_info_result_arr($id, $language);
        $result_arr = $database_result_arr;

        return $result_arr;
    }
}
