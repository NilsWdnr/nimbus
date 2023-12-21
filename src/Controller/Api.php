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

    public function posts() : void
    {
        $posts = $this->post->get_all();
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