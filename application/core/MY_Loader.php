<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    public function __construct() {
        parent::__construct();
    }

    public function controller($class, $params = NULL) {
    	// Don't overwrite existing properties
        $CI =& get_instance();

        // Get the class name, and while we're at it trim any slashes.
		// The directory path can be included as part of the class name,
		// but we don't want a leading slash
		$class = str_replace('.php', '', trim($class, '/'));

		// Was the path included with the class name?
		// We look for a slash to determine this
		if (($last_slash = strrpos($class, '/')) !== FALSE)
		{
			// Extract the path
			$subdir = substr($class, 0, ++$last_slash);

			// Get the filename from the path
			$class = substr($class, $last_slash);
		}
		else
		{
			$subdir = '';
		}

		$class = ucfirst($class);
		$object_name = strtolower($class);
		$filepath = normalize_path(APPPATH.'controllers/'.$subdir.$class.'.php');

		// Does the file exist? No? Bummer...
		if (file_exists($filepath))
		{
			include_once($filepath);
			$CI->$object_name = new $class();
		}
		else
		{
			// If we got this far we were unable to find the requested controller class.
			log_message('error', 'Unable to load the requested controller class: '.$class);
			show_error('Unable to load the requested controller class: ' . $class);
		}
    }
}