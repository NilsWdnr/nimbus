<?php

namespace nimbus\Controller;

use Exception;
use nimbus\Controller;
use nimbus\Model\Product as ProductModel;

final class Products extends Controller {
    private $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new ProductModel;
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

    public function save_new(): void
    {
        if (isset($_FILES["product_image"])) {
            $image_dir = INCLUDE_IMAGES_DIR . DIRECTORY_SEPARATOR . 'products';
            $image_file = $image_dir . DIRECTORY_SEPARATOR . basename($_FILES["product_image"]["name"]);
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $image_file);
            $product_image = $_FILES["product_image"]["name"];
        }

        $create_data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
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
}