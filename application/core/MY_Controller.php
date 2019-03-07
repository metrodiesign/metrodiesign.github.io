<?php
defined('BASEPATH') || exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->data['path_asset_theme_global'] = trim(trim_slashes(base_url($this->config->item('default_theme_global_url'))));
        $this->data['url_base_backend'] = trim(trim_slashes(base_url($this->config->item('default_route_backend'))));
        $this->data['url_base_frontend'] = trim(trim_slashes(base_url()));
        $this->data['url_base_path_image_frontend'] = trim(trim_slashes(base_url()));

        $this->data['path_image_upload'] = '/uploads/';
        $this->data['path_image_public'] = '/uploads/public/';
        $this->data['path_real_image_upload'] = rtrim(FCPATH, '/') . '/uploads/';
        $this->data['path_real_image_public'] = rtrim(FCPATH, '/') . '/uploads/public/';

        $this->data['const_language_frontend']['th'] =
            [
            "id"        => "th",
            "name"      => "Thai",
            "image"     => "th.png",
            "url_image" => $this->data['path_asset_theme_global'] . "/images/lang/th.png",
        ];

        $this->data['const_language_frontend']['en'] =
            [
            "id"        => "en",
            "name"      => "English",
            "image"     => "gb.png",
            "url_image" => $this->data['path_asset_theme_global'] . "/images/lang/gb.png",
        ];

        $this->data['charset'] = (!empty($this->config->item('charset'))) ? $this->config->item('charset') : 'UTF-8';

        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('X-Frame-Options: DENY');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
    }
}

class Backend extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $current_uri = trim(trim_slashes($this->uri->uri_string()));
        $current_uri_arr = (explode('/', $current_uri));
        $current_module = '';
        $current_controller = '';

        if (empty($this->session->userdata('admin_account')))
        {
            if (strtolower($current_uri_arr[0]) == 'backend' && count($current_uri_arr) >= 2)
            {
                $current_module = strtolower($current_uri_arr[1]);
                $current_controller = strtolower($current_uri_arr[2]);
            }
            else
            {
                redirect($this->data['url_base_backend'] . '/auth/login', 'refresh');
            }

            if ($current_module != 'auth' && $current_controller != 'login')
            {
                redirect($this->data['url_base_backend'] . '/auth/login', 'refresh');
            }
        }
        else
        {
            if (strtolower($current_uri_arr[0]) == 'backend')
            {
                $current_module = (isset($current_uri_arr[1]) ? strtolower($current_uri_arr[1]) : '');
                $current_controller = (isset($current_uri_arr[2]) ? strtolower($current_uri_arr[2]) : '');

                if (empty($current_module) && empty($current_controller))
                {
                    redirect($this->data['url_base_backend'] . '/auth/login', 'refresh');
                }
            }
            else
            {
                redirect($this->data['url_base_backend'] . '/auth/login', 'refresh');
            }

            if ($current_module == 'auth' && $current_controller == 'login')
            {
                redirect($this->data['url_base_backend'] . '/admin/account', 'refresh');
            }
        }

        $this->config->set_item('language', 'thai');
        $this->lang->load('backend/default');
        $this->lang->load('backend/menu/menu');

        $this->data['menu_module_name'] = '';
        $this->data['menu_controller_name'] = '';

        $this->data['path_asset_theme_backend'] = trim(trim_slashes(base_url($this->config->item('default_theme_backend_url'))));
    }

    public function render()
    {
        $this->data['view_nav_header'] = $this->load->view('backend/_theme/nav_header', $this->data, true);
        $this->data['view_nav_sidebar'] = $this->load->view('backend/_theme/nav_side', $this->data, true);
        $this->data['view_content'] = $this->load->view($this->data['view_template_content'], $this->data, true);

        $this->load->view('backend/_theme/template', $this->data);
    }
}

class Frontend extends MY_Controller
{
    private $languages = null;
	private $current_language = null;
	private $path_company_image_logo;
    private $path_real_company_image_logo;

    public function __construct()
    {
        parent::__construct();

        $this->config->set_item('language', 'thai');
        $this->lang->load('frontend/default');

		$this->data['path_asset_theme_frontend'] = trim(trim_slashes(base_url($this->config->item('default_theme_frontend_url'))));
		
		$this->path_company_image_logo = $this->data['url_base_frontend'] . '/uploads/company_logo/';
        $this->path_real_company_image_logo = rtrim(FCPATH, '/') . '/uploads/company_logo/';

        $this->data['lang_abbr'] = '';
        $this->data['lang_uri_abbr'] = [];

        $current_uri = rtrim(trim_slashes($this->uri->uri_string()));
        $params = $_SERVER['QUERY_STRING'];

        if (!empty($params))
        {
            $current_uri = trim_slashes($current_uri) . '?' . $params;
        }
        else
        {
            $current_uri = $current_uri . $params;
        }

        $this->languages[] =
            [
            "id"        => "th",
            "name"      => "Thai",
            "directory" => "thai",
            "image"     => "th.png",
            "url_image" => $this->data['path_asset_theme_global'] . "/images/lang/th.png",
        ];

        $this->languages[] =
            [
            "id"        => "en",
            "name"      => "English",
            "directory" => "english",
            "image"     => "gb.png",
            "url_image" => $this->data['path_asset_theme_global'] . "/images/lang/gb.png",
        ];

        foreach ($this->languages as $row)
        {
            if ($row['id'] == 'th')
            {
                $this->current_language = $row['id'];
                $this->data['lang_abbr'] = $row['id'];
                $this->config->set_item('language', $row['directory']);
            }

            $this->data['lang_uri_abbr'][$row['id']] = $row['directory'];
        }

        if (empty($this->current_language))
        {
            $this->current_language = 'th';
        }

        $uri_abbr = $this->uri->segment(1);

        if (isset($this->data['lang_uri_abbr'][$uri_abbr]))
        {
            $current_lang = rtrim(trim_slashes($uri_abbr));

            $this->data['url_base_frontend'] = rtrim(trim_slashes($uri_abbr)) . '/' . $current_lang;
            $this->data['url_base_frontend'] = trim(trim_slashes(base_url())) . '/' . $current_lang;

            $this->config->set_item('language', $this->data['lang_uri_abbr'][$uri_abbr]);
            $this->data['lang_abbr'] = $uri_abbr;
        }
        else
        {
            $this->data['url_base_frontend'] = trim(trim_slashes(base_url()));
        }

        $this->data['switch_lang'] = [];

        if (strlen($uri_abbr) == 2 && isset($this->data['lang_uri_abbr'][$uri_abbr]))
        {
            foreach ($this->languages as $row)
            {
                $this->data['switch_lang'][$row['id']] = [
                    'url'  => substr($this->data['url_base_frontend'], 0, strlen($this->data['url_base_frontend']) - 3) . '/' . rtrim($row['id'], '/') . '/' . rtrim(substr($current_uri, 3), '/'),
                    'name' => $row['id'],
                ];

                if ($this->data['lang_abbr'] == $row['id'])
                {
                    $this->data['current_language'] = $row['id'];
                }
            }
        }
        else
        {
            foreach ($this->languages as $row)
            {
                $this->data['switch_lang'][$row['id']] = [
                    'url' => substr($this->data['url_base_frontend'], 0, strlen($this->data['url_base_frontend']) - 0) . '/' . rtrim($row['id'], '/') . '/' . rtrim(substr($current_uri, 0), '/'),
                ];

                if ($this->data['lang_abbr'] == $row['id'])
                {
                    $this->data['current_language'] = $row['id'];
                }
            }
        }

		$this->lang->load('frontend/default', $this->config->item('language'));
    }

    public function render()
    {
        $this->data['view_content'] = $this->load->view($this->data['view_template_content'], $this->data, true);

        $this->load->view('frontend/_theme/template', $this->data);
    }
}
