<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Controller\Api;

final class Error extends Controller {
    private $api;

    public function __construct()
    {
        parent::__construct();
        $this->api = new Api();
    }

    public function browser_error(string $message){

    }

    public function api_error(string $message){
        $this->api->send_message($message);
    }
}