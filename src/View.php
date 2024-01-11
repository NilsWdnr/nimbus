<?php

namespace nimbus;

final class View{
    private $page_title;

    public function load_view(string $name, array $args = []) : void
    {
        $view_name = ucfirst($name) . 'View';
        $view_file = VIEWS_DIR . DIRECTORY_SEPARATOR . $view_name . '.php';


        $this->load_head_template();
        $this->load_file($view_file,$args);
        $this->load_footer_template();
    }

    private function load_file(string $file, array $args = []) : void
    {

        if(file_exists($file)){
            include_once($file);
        } else {
            echo 'Error: The requested view file could not be found';
            die;
        }
    }

    public function set_title(string $title) : void
    {
        $this->page_title = $title;
    }

    private function load_head_template() : void
    {
        $template_dir = VIEWS_DIR . DIRECTORY_SEPARATOR . 'Templates';

        $head_template_file = $template_dir . DIRECTORY_SEPARATOR . 'Head.php';
        $this->load_file($head_template_file);

        if(isset( $_SESSION['login'] )){
            $sidebar_template_file = $template_dir . DIRECTORY_SEPARATOR . 'Sidebar.php';
            $this->load_file($sidebar_template_file);
        }
    }

    private function load_footer_template() : void
    {

    }
}