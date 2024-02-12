<?php

namespace nimbus\Controller;

use nimbus\Controller;

final class Settings extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->GuestsOnly();
    }

    public function index(): void
    {
        $this->view->set_title('Settings');
        $this->view->show_sidebar();
        $this->view->load_view('Settings');
    }
}