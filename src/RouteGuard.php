<?php

namespace Nimbus;

final class RouteGuard extends Controller {
    public function GuestsOnly() : void
    {
        if(!isset( $_SESSION['login'] )){
            //load dashboard
            $this->redirect('/dashboard');
        }
    }
}