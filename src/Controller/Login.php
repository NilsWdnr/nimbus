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
            if($this->check_login($_POST)){
                $this->redirect('/dashboard');
            } else {
                echo 'Login fehlgeschlagen';
            }
        }
    }

    private function check_login(array $login_data) : bool
    {
        $found_user = $this->user->find_by_name($login_data['username']);
        if($found_user===[]){
            return false;
        } else if(password_verify($login_data['password'],$found_user['password'])){

            $_SESSION['login'] = [
                'user_id' => $found_user['id'],
                'username' => $found_user['username']
            ];
            return true;
        }

        return false;
    }
}
