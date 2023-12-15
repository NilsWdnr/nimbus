<?php

namespace nimbus;

use nimbus\Test;

final class App {
    public function __construct()
    {
        echo 'App loadeed';
        new Test();
    }
}