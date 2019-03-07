<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_youtube_id_from_url')) 
{
	function get_youtube_id_from_url($url) 
	{
		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
		$youtube_id = (!empty($match[1]) ? $match[1] : '');

		return $youtube_id;
	}
}