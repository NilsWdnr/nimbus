<?php

namespace nimbus;

use Error;

final class View{
    private $page_title;
    private $navbar_visible;

    public function __construct()
    {
        $this->navbar_visible = false;
    }

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
            throw new Error('The view template you are trying to load does not exist. This is the file you tried to include: ' . $file);
        }
    }

    public function set_title(string $title) : void
    {
        $this->page_title = $title;
    }

    //call function if the sidebar should be loaded. Must be called before 'load view' for it to affect the view
    public function show_sidebar() : void {
        $this->navbar_visible = true;
    }

    private function load_head_template() : void
    {
        $template_dir = VIEWS_DIR . DIRECTORY_SEPARATOR . 'Templates';

        $head_template_file = $template_dir . DIRECTORY_SEPARATOR . 'Header.php';
        $this->load_file($head_template_file);

        if($this->navbar_visible===true){
            $sidebar_template_file = $template_dir . DIRECTORY_SEPARATOR . 'Sidebar.php';
            $this->load_file($sidebar_template_file);
        }

    }

    private function load_footer_template() : void
    {

    }
}