<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Controller\Api;

final class Error extends Controller {
    private $api;

    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function browser_error(string $message){
        $this->view->set_title('Error');
        $this->view->load_view('Error',['message'=>$message]);
    }

    public function api_error(string $message){
        $this->api = new Api();
        $this->api->send_message($message);
    }
}