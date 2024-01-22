<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\Post;
use nimbus\Model\Job;

final class Api extends Controller {
    private $post;
    private $job;

    public function __construct()
    {
        parent::__construct();
        $this->post = new Post();
        $this->job = new Job();
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

    public function jobs(int $amount = 0) : void
    {
        $jobs = [];
        if($amount === 0){
            $jobs = $this->job->get_all();
        } else {
            $jobs = $this->job->get_amount($amount);
        }

        echo json_encode($jobs);
    }

    public function job(int $id): void
    {
        $job = $this->job->get_by_id($id);
        if($job===[]){
            echo json_encode(NULL);
        } else {
            echo json_encode($job);
        }
    }

    public function send_message(string $message){
        echo json_encode($message);
    }
}