<?php

namespace nimbus;

use nimbus\View;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function redirect(string $location): void
    {
        header( "Location: {$location}" );
        exit();
    }
}
