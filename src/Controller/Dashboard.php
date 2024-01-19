<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\Post;

final class Dashboard extends Controller {
    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->GuestsOnly();
        $this->post = new Post();
    }

    public function index() : void
    {
        $posts = $this->post->get_all();

        $view_args = [
            'username' => $_SESSION['login']['username'],
            'posts' => $posts
        ];

        $this->view->set_title('Dashboard');
        $this->view->show_sidebar();
        $this->view->load_view('dashboard',$view_args);
    }
}