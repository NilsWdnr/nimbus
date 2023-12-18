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

        $this->user = new User();
    }

    public function index() : void
    {
        $this->view->set_title('Login');
        $this->view->load_view('login');

        if($_POST!==[]){
            $this->check_login($_POST);
        }
    }

    private function check_login(array $login_data) : bool
    {
        $found_user = $this->user->find_by_name($login_data['username']);
        var_dump($found_user);
        return true;
    }
}
