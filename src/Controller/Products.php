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
        $this->view->load_view('PostEdit',$args);
    }
}