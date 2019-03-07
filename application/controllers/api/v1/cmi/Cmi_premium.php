<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Cmi_premium extends REST_Controller
{
    private $vstorecmi_url;

    public function __construct()
    {
        parent::__construct();

        $this->vstorecmi_url = $this->config->item('viriyah_vstorecmi_url');
    }
    public function index_get()
    {
        $results = [];

        $CarMake = $this->input->get('CarMake', true);
        $CarModel = $this->input->get('CarModel', true);
        $CarType = $this->input->get('CarType', true);

        $input_get = [
            'CarMake'  => $CarMake,
            'CarModel' => $CarModel,
            'CarType'  => $CarType,
        ];

        $this->form_validation->set_data($input_get);
        $this->form_validation->set_rules('CarMake', 'CarMake', 'trim|required');
        $this->form_validation->set_rules('CarModel', 'CarModel', 'trim|required');
        $this->form_validation->set_rules('CarType', 'CarType', 'trim|required|integer');

        if ($this->form_validation->run() == false)
        {
            $this->set_response(
                [
                    'errors'  => $this->form_validation->error_array(),
                    'code'    => 400,
                    'message' => 'CMI Premium could not be found',
                ],
                REST_Controller::HTTP_BAD_REQUEST
            );
        }
        else
        {
            $this->curl->create($this->vstorecmi_url . 'CmiPremium?CarMake=' . rawurlencode($CarMake) . '&CarModel=' . rawurlencode($CarModel) . '&CarType=' . rawurlencode($CarType));
            $this->curl->option(CURLOPT_USERPWD, $this->config->item('viriyah_basic_auth'));
            $results = $this->curl->execute();
            $results = json_decode($results, true);

            if (!empty($results))
            {
                if (!is_array($results))
                {
                    $this->set_response(
                        [
                            'data' => $results,
                        ],
                        REST_Controller::HTTP_OK
                    );
                }
                else
                {
                    $cmi_premium = $results;

                    $this->set_response(
                        [
                            'data' => $cmi_premium,
                        ],
                        REST_Controller::HTTP_OK
                    );
                }
            }
            else
            {
                $this->set_response([
                    'status'  => false,
                    'message' => 'CMI Premium could not be found',
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
