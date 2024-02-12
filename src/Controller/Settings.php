<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\User;

final class Settings extends Controller {
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->GuestsOnly();
        $this->user = new User();
    }

    public function index(): void
    {
        $this->view->set_title('Settings');
        $this->view->show_sidebar();
        $this->view->load_view('Settings');
    }

    public function save_password(): void
    {
        if($this->user->verify_password($_SESSION['login']['username'],$_POST['old_password'])){
            $this->redirect('/settings?passwordSuccess');
        } else {
            echo 'Wrong Password';
        }
    }

    public function password_changed(): void
    {
        $this->user->log_out();
        $this->view->set_title('Password changed');
        $this->view->load_view('PasswordChanged');
    }
}