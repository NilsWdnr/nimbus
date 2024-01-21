<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\Post;
use nimbus\Model\User;

final class Api extends Controller {
    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->post = new Post();
        header('Content-Type: application/json; charset=utf-8');
    }

    // get all posts or a specific amount of posts
    public function posts(int $amount = 0) : void
    {
        $posts = [];
        if($amount === 0){
            $posts = $this->post->get_all();
        } else {
            $posts = $this->post->get_amount($amount);
        }

        echo json_encode($posts);
    }

    public function post(int $id) : void
    {
        $post = $this->post->get_by_id($id);
        if($post===[]){
            echo json_encode(NULL);
        } else {
            echo json_encode($post);
        }
    }

    public function send_message(string $message){
        echo json_encode($message);
    }
}