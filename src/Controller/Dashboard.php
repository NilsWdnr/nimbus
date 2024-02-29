<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\Job;
use nimbus\Model\Post;
use nimbus\Model\Product;

final class Dashboard extends Controller
{
    private $post;
    private $product;
    private $job;

    public function __construct()
    {
        parent::__construct();
        $this->GuestsOnly();
        $this->post = new Post();
        $this->product = new Product();
        $this->job = new Job();
    }

    public function index(): void
    {
        $posts = $this->post->get_amount(3);
        $products = $this->product->get_amount(3);
        $jobs = $this->job->get_amount(3);

        $view_args = [
            'username' => $_SESSION['login']['username'],
            'posts' => $posts,
            'products' => $products,
            'jobs' => $jobs
        ];

        $this->view->set_title('Dashboard');
        $this->view->show_sidebar();
        $this->view->load_view('dashboard', $view_args);
    }
}
