<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Router extends CI_Router {

	function _set_request($segments = array()) {
		$segment_count = count($segments) - 1;

		for ($i = 0; $i < $segment_count; $i++) { 
			$segments[$i] = str_replace('-', '_', $segments[$i]);
		}

		return parent::_set_request($segments);
	}
}