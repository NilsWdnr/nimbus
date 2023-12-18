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
    }

    public function index() : void
    {
        $this->view->set_title('Dashboard');
        $this->view->load_view('dashboard');
    }
}