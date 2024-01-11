<?php

namespace nimbus\Controller;

use Exception;
use nimbus\Controller;
use nimbus\Model\Post as PostModel;

final class Posts extends Controller {
    private $postModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new PostModel();
    }

    public function edit(int $id = 0) : void
    {
        $post = $this->postModel->get_by_id($id);
        $args = [...$post];
        $args['method'] = "edit";
        $this->view->set_title('Edit Post');
        $this->view->load_view('Edit',$args);
    }

    public function save(int $id) : void
    {
        $update_data = [
            "title"=>$_POST['title'],
            "content"=>$_POST['content'],
        ];
        if($this->postModel->update($id,$update_data)){
            $this->redirect('/dashboard');
        } else {
            throw new Exception('Es ist ein Fehler beim Speichern des Posts aufgetreten.');
        }
    }

    public function create() : void
    {
        $args = [
            'method' => 'create'
        ];

        $this->view->set_title('Create Post');
        $this->view->load_view('Edit',$args);
    }

    public function save_new() : void
    {
        $create_data = [
            'title'=>$_POST['title'],
            'content'=>$_POST['content'],
            'date'=>date("Y-m-d H:i:s")
        ];

        if($this->postModel->insert($create_data)){
            $this->redirect('/dashboard');
        } else {
            throw new Exception('Fehler beim Erstellen des Posts');
        }
    }
}