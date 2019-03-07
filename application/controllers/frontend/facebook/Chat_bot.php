<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Chat_bot extends Frontend
{
    private $appSecret;
    private $pageAccessToken;
    private $validationToken;
    private $serverURL;
    private $hubChallenge;

    public function __construct()
    {
        parent::__construct();

        $this->appSecret = '1C1CHBFenTH813TH814biw1920bih969ei97OAXKvUI8vUz7sP66aFqAE';
        $this->pageAccessToken = 'EAAekhd4mZAMwBAKmonWopaobeI2SZBwoqd0mGbR5k3K4VbXYT2vUaudHZCYf2JqoA0Kq9naGxE1vty8RQQhh5U5doDHgMXTzJm6C7Pc0URZCp3h2mcjqL2i4qpsFHz94RjOkz7qqREYHOZCrNtvfmOFI01hQGTjZB6dwyobDGp8ZC5GEwZATPwJS';
        $this->validationToken = '';
        $this->serverURL = '';
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
        if ($this->input->get('hub_challenge'))
        {
            $this->hubChallenge = $this->input->get('hub_challenge');
            $this->validationToken = $this->input->get('hub_verify_token');
        }

        if ($this->validationToken === $this->appSecret)
        {
            echo $this->hubChallenge;
        }

        // handle bot's anwser
        $input = json_decode(file_get_contents('php://input'), true);

        for ($i = 0; $i < count($input['entry'][0]['messaging']); $i++)
        {
            $senderId = $input['entry'][0]['messaging'][$i]['sender']['id'];
            $messageText = $input['entry'][0]['messaging'][$i]['message']['text'];
            $response = null;

            if (!empty($senderId) && !empty($messageText)) {
                $response = [
                    'recipient' => ['id' => $senderId],
                    'message'   => ['text' => 'Hello'],
                ];

                $options = array
                (
                    'http' => 'POST',
                    'content' => json_encode($response),
                    'header' => "Content-Type: application/json\n"
                );

                $context = stream_context_create($options);
                file_get_contents('https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->pageAccessToken);
            }
        }
    }
}
