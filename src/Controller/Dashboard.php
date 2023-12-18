<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\User;

final class Dashboard extends Controller {
    private $user;

    public function __construct()
    {
        echo 'loaded dashboard controller';
    }
}