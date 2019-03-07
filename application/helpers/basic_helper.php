<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('pr')) 
{
	function pr($data = array()) 
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

if (!function_exists('required')) 
{
	function required() 
	{
		echo '<span class="text-danger">*</span>';
	}
}

if (!function_exists('normalize_path')) 
{
	function normalize_path($path) 
	{
	    $parts = array();// Array to build a new path from the good parts
	    $path = str_replace('\\', '/', $path);// Replace backslashes with forwardslashes
	    $path = preg_replace('/\/+/', '/', $path);// Combine multiple slashes into a single slash
	    $segments = explode('/', $path);// Collect path segments
	    $test = '';// Initialize testing variable
	    foreach ($segments as $segment)
	    {
	        if ($segment != '.')
	        {
	            $test = array_pop($parts);

	            if (is_null($test)) {
	                $parts[] = $segment;
	            }
	            elseif ($segment == '..')
	            {
	                if ($test == '..')
	                {
	                    $parts[] = $test;
	                }

	                if ($test == '..' || $test == '') 
	                {
	                    $parts[] = $segment;
	                }
	            }
	            else
	            {
	                $parts[] = $test;
	                $parts[] = $segment;
	            }
	        }
	    }
	    
	    return implode('/', $parts);
	}
}

if (!function_exists('alphanumeric_rand')) 
{
	function alphanumeric_rand($num_require = 8) 
	{
	    $randomstring = '';
	    $alphanumeric = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);

	    if ($num_require > sizeof($alphanumeric)) 
	    {
	        echo "Error alphanumeric_rand(\$num_require) : \$num_require must less than " . sizeof($alphanumeric) . ", $num_require given";
	        return;
	    }

	    $rand_key = array_rand($alphanumeric, $num_require);

	    for ($i = 0; $i < sizeof($rand_key); $i++)
	        $randomstring .= $alphanumeric[$rand_key[$i]];
	    return $randomstring;
	}
}