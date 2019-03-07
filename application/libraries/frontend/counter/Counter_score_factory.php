<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Counter_score_factory
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model('frontend/counter/counter_score_model');
    }

    public function get_counter_score_details_result_arr($id = 0, $language = 'th')
    {
        $result_arr = [];

        if (!is_numeric($id) || $id == 0)
        {
            return $result_arr;
        }

        $database_result_arr = $this->CI->counter_score_model->get_counter_details_result_arr($id, $language);
        $result_arr = $database_result_arr;

        return $result_arr;
    }
}
