<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\User;

final class Login extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();

        $this->view->set_title('Login');
        $this->view->load_view('login');

        $this->user = new User();
    }

    public function index(){
        echo "index method executed";
    }
}
