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
        
    }
}