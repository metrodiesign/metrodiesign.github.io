<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------

if (!function_exists('compress_url_query_string'))
{
	function compress_url_query_string($args = '')
	{
		$url = '';

		if ($args) 
		{
			if (is_array($args)) 
			{
				$url .= '&amp;' . http_build_query($args);
			} 
			else 
			{
				$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
			}
		}

		return $url;
	}
}