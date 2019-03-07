<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Index extends Frontend
{
    public function __construct()
    {
        parent::__construct();
    }

    public function _remap($method, $params = [])
    {
        $method = str_replace('_', '-', $method);

        if (empty($method))
        {
            $method = 'index';
        }

        if (method_exists($this, $method))
        {
            return call_user_func_array([$this, $method], $params);
        }
        else
        {
            redirect('error_404', 'refresh');
        }
    }

    public function index()
    {
        redirect($this->data['url_base_frontend'] . '/cmi/cmi');
    }
}
