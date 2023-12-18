<?php

namespace nimbus;

final class App
{

    public function __construct()
    {
        session_start();

        $request = $this->parse_URL();

        $this->load_controller($request['controller']);
    }

    // get requested controller, method and argument from url
    private function parse_URL(): array
    {
        $url = filter_input(INPUT_GET, '_url') ?? '';
        $url_lower = strtolower($url);
        $url_parts = explode('/', $url_lower);

        $controller = $url_parts[0] !== '' ? $url_parts[0] : 'index';
        $method = $url_parts[1] ?? NULL;
        $argument = $url_parts[2] ?? NULL;

        $request = [
            'controller' => $controller,
            'method' => $method,
            'argument' => $argument
        ];

        return $request;
    }

    private function load_controller (string $controller) : void
    {
        $controller_name = ucfirst( $controller );
        $controller_class = "nimbus\\Controller\\{$controller_name}";
        $index_class = "nimbus\\Controller\\Index";

        if(class_exists($controller_class)){
            $controller = new $controller_class();
            $controller->index();
        } else {
            $controller = new $index_class;
            $controller->index();
        }
    }
}
