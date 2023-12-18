<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\User;

final class Dashboard extends Controller {
    private $user;

    public function __construct()
    {
        parent::__construct();
        // echo 'loaded dashboard controller';

        // only allowed if logged in
        if(!isset($_SESSION['login'])){
            $this->redirect('/login');
        }
    }

    public function index() : void
    {
        $view_args = [
            'username' => $_SESSION['login']['username']
        ];

        $this->view->set_title('Dashboard');
        $this->view->load_view('dashboard',$view_args);
    }
}