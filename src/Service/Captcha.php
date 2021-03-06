<?php
namespace App\Service;

class Captcha {
    // response send bien captcha
    private $response;
    private $secret;

    function __construct($response)
    {
        $this->response = $response;
        $this->secret = $_ENV['CAPTCHA_SECRET_KEY'];
    }

    public function captchaIsValid(){
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$this->secret}&response={$this->response}");
        $json = json_decode($response);
        return $json->success;
    }
}