<?php

namespace nimbus\Controller;

use Exception;
use nimbus\Controller;
use nimbus\Model\Post as PostModel;

final class Posts extends Controller
{
    private $postModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new PostModel();
    }

    public function index(): void
    {
        $posts = $this->postModel->get_all();

        $view_args = [
            'posts' => $posts
        ];

        $this->view->set_title('Posts');
        $this->view->show_sidebar();
        $this->view->load_view('posts', $view_args);
    }

    public function edit(int $id = 0): void
    {
        $post = $this->postModel->get_by_id($id);
        $args = [...$post];
        $args['method'] = "edit";
        $this->view->set_title('Edit Post');
        $this->view->show_sidebar();
        $this->view->load_view('PostEdit', $args);
    }

    public function delete(int $id): void
    {
        if ($this->postModel->delete($id)) {
            $this->redirect($_SERVER['HTTP_REFERER']);
        } else {
            throw new Exception('Es ist ein Fehler beim löschen des Posts aufgetreten.');
        }
    }

    public function save(int $id): void
    {
        $update_data = [
            "title" => $_POST['title'],
            "content" => $_POST['content'],
        ];

        if (isset($_FILES["title_image"])) {
            $image_dir = INCLUDE_IMAGES_DIR . DIRECTORY_SEPARATOR . 'posts';
            $image_file = $image_dir . DIRECTORY_SEPARATOR . basename($_FILES["title_image"]["name"]);
            move_uploaded_file($_FILES["title_image"]["tmp_name"], $image_file);
            $title_image = $_FILES["title_image"]["name"];

            $update_data["title_image"] = $title_image;
        }

        if ($this->postModel->update($id, $update_data)) {
            $this->redirect('/dashboard');
        } else {
            throw new Exception('Es ist ein Fehler beim Speichern des Posts aufgetreten.');
        }
    }

    public function create(): void
    {
        $args = [
            'method' => 'create'
        ];

        $this->view->set_title('Create Post');
        $this->view->show_sidebar();
        $this->view->load_view('PostEdit', $args);
    }

    public function save_new(): void
    {
        $title_image = "";
        if (isset($_FILES["title_image"])) {
            $image_dir = INCLUDE_IMAGES_DIR . DIRECTORY_SEPARATOR . 'posts';
            $image_file = $image_dir . DIRECTORY_SEPARATOR . basename($_FILES["title_image"]["name"]);
            move_uploaded_file($_FILES["title_image"]["tmp_name"], $image_file);
            $title_image = $_FILES["title_image"]["name"];
        }

        $create_data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'date' => date("Y-m-d H:i:s"),
            'title_image' => $title_image
        ];

        if ($this->postModel->insert($create_data)) {
            $this->redirect('/dashboard');
        } else {
            throw new Exception('Fehler beim Erstellen des Posts');
        }
    }
}
