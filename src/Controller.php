<?php

namespace nimbus;

abstract class Controller
{
    protected function redirect(string $location): void
    {
        header( "Location: {$location}" );
        exit();
    }
}
