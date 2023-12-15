<?php

namespace nimbus\Controller;

use nimbus\Controller;

final class Index extends Controller {
    public function __construct()
    {
        if(isset( $_SESSION['login'] )){
            //load dashboard
            $this->redirect('/dashboard');
        } else {
            //redirect to login
            $this->redirect('/login');
        }
    }
}