<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\Post as PostModel;

final class Post extends Controller {
    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function edit(int $id = 0) : void
    {
        $post = $this->postModel->get_by_id($id);
        var_dump($post);
    }
}