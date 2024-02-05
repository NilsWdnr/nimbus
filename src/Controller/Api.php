<?php

namespace nimbus\Controller;

use Exception;
use nimbus\Controller;
use nimbus\Model\Validation;
use nimbus\Model\Post;
use nimbus\Model\Job;
use nimbus\Model\Product;
use Throwable;

final class Api extends Controller
{
    private $post;
    private $product;
    private $job;
    private $validation;

    public function __construct()
    {
        parent::__construct();
        $this->post = new Post();
        $this->product = new Product();
        $this->job = new Job();
        $this->validation = new Validation();
        header('Content-Type: application/json; charset=utf-8');
    }

    // get all posts or a specific amount of posts
    public function posts(int $amount = 0): void
    {
        $posts = [];
        if ($amount === 0) {
            $posts = $this->post->get_all();
        } else {
            $posts = $this->post->get_amount($amount);
        }

        echo json_encode($posts);
    }

    public function post(int $id): void
    {
        $post = $this->post->get_by_id($id);
        if ($post === []) {
            echo json_encode(NULL);
        } else {
            echo json_encode($post);
        }
    }

    //get all products
    public function products(): void
    {
        $products = $this->product->get_all();
        echo json_encode($products);
    }

    //get single product by id
    public function product(int $id): void
    {
        $product = $this->product->get_by_id($id);
        echo json_encode($product);
    }

    public function jobs(int $amount = 0): void
    {
        $jobs = [];

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($amount === 0) {
                $jobs = $this->job->get_all();
            } else {
                $jobs = $this->job->get_amount($amount);
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_data = json_decode(file_get_contents("php://input"), true);
            
            try {
                $jobs = $this->job->get_all_filtered($post_data);
            } catch (Throwable $e) {
                $this->send_message('There was a problem with your post request. Please check the parameters in your request body');
                return;
            }
        }

        echo json_encode($jobs);
    }

    public function job(int $id): void
    {
        $job = $this->job->get_by_id($id);
        if ($job === []) {
            echo json_encode(NULL);
        } else {
            echo json_encode($job);
        }
    }

    public function contact(): void {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Please send a post request with the form data');
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        $this->validation->set_rules([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $success = $this->validation->validate($data);
        $messages = $this->validation->get_messages();

        $return_data = [
            'success' => $success,
            'messages' => $messages
        ];

        echo json_encode($return_data);
    }

    public function send_message(string $message)
    {
        echo json_encode($message);
    }
}
