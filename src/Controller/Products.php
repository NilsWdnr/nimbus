<?php

namespace nimbus\Controller;

use Exception;
use nimbus\Controller;
use nimbus\Model\Validation;
use nimbus\Model\Product as ProductModel;

final class Products extends Controller {
    private $productModel;
    private $validation;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new ProductModel;
        $this->validation = new Validation;
    }

    public function index() : void
    {
        $products = $this->productModel->get_all();

        $view_args = [
            'products' => $products
        ];

        $this->view->set_title('Products');
        $this->view->show_sidebar();
        $this->view->load_view('Products',$view_args);
    }

    public function create() : void
    {
        $args = [
            'method' => 'create'
        ];

        $this->view->set_title('Create Product');
        $this->view->show_sidebar();
        $this->view->load_view('ProductEdit',$args);
    }

    public function edit(int $id) : void
    {
        $product = $this->productModel->get_by_id($id);
        $args = [...$product];
        $args['method'] = "edit";

        $this->view->set_title('Edit Product');
        $this->view->show_sidebar();
        $this->view->load_view('ProductEdit', $args);
    }

    public function save(int $id): void
    {
        $update_data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => (float)$_POST['price'],
            'product_type' => $_POST['product_type'],
        ];

        if (isset($_FILES["product_image"])) {
            $product_image = $this->save_image($_FILES["product_image"]);
            $update_data['product_images'] = $product_image;
        }

        if ($this->productModel->update($id, $update_data)) {
            $this->redirect('/products');
        } else {
            throw new Exception('Es ist ein Fehler beim Speichern des Produktes aufgetreten.');
        }
    }

    public function save_new(): void
    {
        $this->validation->set_rules(['title'=>'required']);


        $product_image = "";

        if (isset($_FILES["product_image"])) {
            // $image_dir = INCLUDE_IMAGES_DIR . DIRECTORY_SEPARATOR . 'products';
            // $image_file = $image_dir . DIRECTORY_SEPARATOR . basename($_FILES["product_image"]["name"]);
            // move_uploaded_file($_FILES["product_image"]["tmp_name"], $image_file);
            // $product_image = $_FILES["product_image"]["name"];

            //sanitize file name
            $product_image = $this->save_image($_FILES["product_image"]);
        }

        $create_data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => (float)$_POST['price'],
            'product_type' => $_POST['product_type'],
            'product_images' => $product_image,
            'date_created' => date("Y-m-d H:i:s"),
        ];

        if($this->productModel->insert($create_data)){
            $this->redirect('/products');
        } else {
            throw new Exception('Fehler beim Erstellen des Produktes');
        }
    }

    private function save_image(array $image): string 
    {
        $image_dir = INCLUDE_IMAGES_DIR . DIRECTORY_SEPARATOR . 'products';
        $original_file_name = $image["name"];
        $cleaned_file_name = str_replace(' ', '_', $original_file_name);
        $image_file = $image_dir . DIRECTORY_SEPARATOR . basename($cleaned_file_name);
        move_uploaded_file($image["tmp_name"], $image_file);
        return $cleaned_file_name;
    }
}