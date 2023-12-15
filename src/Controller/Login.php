<?php

namespace nimbus\Controller;

use nimbus\Controller;

final class Login extends Controller {
    public function __construct()
    {
        parent::__construct();

        $this->view->set_title('Login');
        $this->view->load_view('login');
    }
}