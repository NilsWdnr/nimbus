<?php

namespace nimbus;

final class View{
    public function load_view(string $name) : void
    {
        $view_name = ucfirst($name) . 'View';
    }
}