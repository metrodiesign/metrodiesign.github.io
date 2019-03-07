<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Car extends REST_Controller
{
    private $vstorecore_url;

    public function __construct()
    {
        parent::__construct();

        $this->vstorecore_url = $this->config->item('viriyah_vstorecore_url');
    }

    public function car_types_get()
    {
        $results = [];

        $results[] = [
            'id'   => 1,
            'text' => 'รถส่วนบุคคล',
        ];

        $results[] = [
            'id'   => 3,
            'text' => 'รถรับจ้างหรือให้เช่า',
        ];

        if (!empty($results))
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
            $this->set_response([
                'status'  => false,
                'message' => 'Car types could not be found',
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function car_models_get()
    {
        $results = [];

        $carGroup = $this->input->get('cargroup', true);
        $carRegisYear = $this->input->get('carRegisYear', true);
        $carNameCode = $this->input->get('carname_code', true);

        $input_get = [
            'carGroup'     => $carGroup,
            'carRegisYear' => $carRegisYear,
            'carNameCode'  => $carNameCode,
        ];

        $this->form_validation->set_data($input_get);
        $this->form_validation->set_rules('carGroup', 'carGroup', 'trim|required|integer');
        $this->form_validation->set_rules('carRegisYear', 'carRegisYear', 'trim|required|integer');
        $this->form_validation->set_rules('carNameCode', 'carNameCode', 'trim|required');

        if ($this->form_validation->run() == false)
        {
            $this->set_response(
                [
                    'errors'  => $this->form_validation->error_array(),
                    'code'    => 400,
                    'message' => 'Car models could not be found',
                ],
                REST_Controller::HTTP_BAD_REQUEST
            );
        }
        else
        {
            $this->curl->create($this->vstorecore_url . 'Cars/CarModels?cargroup=' . $carGroup . '&carname_code=' . $carNameCode . '&carRegisYear=' . $carRegisYear);
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
                    $carModels = [''];

                    foreach ($results as $key => $value)
                    {
                        $carModels[] =
                            [
                            'id'   => $value['carModelSub'],
                            'text' => $value['carModel'],
                        ];
                    }

                    $this->set_response(
                        [
                            'data' => $carModels,
                        ],
                        REST_Controller::HTTP_OK
                    );
                }
            }
            else
            {
                $this->set_response([
                    'status'  => false,
                    'message' => 'Car models could not be found',
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function car_makes_get()
    {
        $results = [];

        $carGroup = $this->input->get('cargroup', true);
        $carRegisYear = $this->input->get('carRegisYear', true);

        $input_get = [
            'carGroup'     => $carGroup,
            'carRegisYear' => $carRegisYear,
        ];

        $this->form_validation->set_data($input_get);
        $this->form_validation->set_rules('carGroup', 'carGroup', 'trim|required|integer');
        $this->form_validation->set_rules('carRegisYear', 'carRegisYear', 'trim|required|integer');

        if ($this->form_validation->run() == false)
        {
            $this->set_response(
                [
                    'errors'  => $this->form_validation->error_array(),
                    'code'    => 400,
                    'message' => 'car makes could not be found',
                ],
                REST_Controller::HTTP_BAD_REQUEST
            );
        }
        else
        {
            $this->curl->create($this->vstorecore_url . 'Cars/CarMakes?cargroup=' . $carGroup . '&carRegisYear=' . $carRegisYear);
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
                    $carMakes = [''];

                    foreach ($results as $key => $value)
                    {
                        $carMakes[] =
                            [
                            'id'   => $value['carname_code'],
                            'text' => $value['carMake'],
                        ];
                    }

                    $this->set_response(
                        [
                            'data' => $carMakes,
                        ],
                        REST_Controller::HTTP_OK
                    );
                }
            }
            else
            {
                $this->set_response([
                    'status'  => false,
                    'message' => 'Car markes could not be found',
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
