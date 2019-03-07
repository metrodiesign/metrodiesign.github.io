<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_factory
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->library('user_agent');
		$this->CI->load->model('frontend/contact_us/client_model');
	}

	public function create($data = array())
	{
		$date = date('Y-m-d H:i:s');
		$data_arr_to_database = array();

		$data_arr_to_database['client']['ip_address'] = $this->CI->input->ip_address();
		$data_arr_to_database['client']['agent'] = $this->CI->agent->agent_string();
		$data_arr_to_database['client']['name'] = $data['name'];
		$data_arr_to_database['client']['email'] = $data['email'];
		$data_arr_to_database['client']['subject'] = $data['subject'];
		$data_arr_to_database['client']['message'] = htmlspecialchars($data['message'], ENT_QUOTES);
		$data_arr_to_database['client']['create_datetime'] = $date;

        $trans = $this->CI->client_model->insert($data_arr_to_database);
        
        return $trans;
	}
}