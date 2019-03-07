<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mortor_cmi
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function get_car_makes($url = null)
	{
		$this->CI->curl->create($url);
        $this->CI->curl->option(CURLOPT_USERPWD, $this->CI->config->item('viriyah_basic_auth'));
        $car_makes = $this->CI->curl->execute();
		
		return $car_makes;
	}
}