<?php

namespace nimbus\Controller;

use nimbus\Controller;
use nimbus\Model\Post as PostModel;

final class Post extends Controller {
    private $postModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new PostModel();
    }

    public function edit(int $id = 0) : void
    {
        $post = $this->postModel->get_by_id($id);
        $this->view->set_title('Edit Post');
        $this->view->load_view('Edit',$post);
    }

    public function save(int $id) : void
    {
        $update_data = [
            "title"=>$_POST['title'],
            "content"=>$_POST['content'],
        ];
        if($this->postModel->update($id,$update_data)){
            return;
        } else {
            echo 'Fehler beim updaten des Posts';
        }
    }
}