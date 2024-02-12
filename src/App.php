<?php

namespace nimbus;

use Throwable;
use nimbus\Controller\Error;

final class App
{
    private $error;

    public function __construct()
    {
        session_start();

        $this->error = new Error();

        $request = $this->parse_URL();

        $this->load_controller($request);
    }

    // get requested controller, method and argument from url
    private function parse_URL(): array
    {
        $url = filter_input(INPUT_GET, '_url', FILTER_SANITIZE_URL) ?? '';
        $url = urldecode($url);
        $url_lower = strtolower($url);
        $url_parts = explode('/', $url_lower);

        $controller = preg_replace('/[^a-zA-Z0-9]/', '', $url_parts[0] ?? '');
        $controller = $controller !== '' ? $controller : 'index';


        $method = isset($url_parts[1]) && $url_parts[1] !== "" ? preg_replace('/[^a-zA-Z0-9_]/', '', $url_parts[1]) : NULL;
        $argument = isset($url_parts[2]) && $url_parts[2] !== "" ? preg_replace('/[^a-zA-Z0-9_]/', '', $url_parts[2]) : NULL;

        $request = [
            'controller' => $controller,
            'method' => $method,
            'argument' => $argument
        ];

        return $request;
    }


    private function load_controller(array $request): void
    {
        $controllerName = ucfirst($request['controller']);
        $controllerClass = "nimbus\\Controller\\{$controllerName}";
        $defaultControllerClass = "nimbus\\Controller\\Index";

        $method = $request['method'] ? strtolower($request['method']) : null;
        $argument = $request['argument'];

        try {
            $controller = class_exists($controllerClass) ? new $controllerClass() : new $defaultControllerClass();

            if (!is_null($method) && method_exists($controller, $method)) {
                if (!is_null($argument)) {
                    $controller->{$method}($argument);
                } else {
                    $controller->{$method}();
                }
            } else {
                $controller->index();
            }
        } catch (Throwable $e) {
            $this->handle_error($e, $controllerName);
        }
    }

    private function handle_error(Throwable $e, mixed $controllerName): void
    {
        if (!is_null($controllerName) && strtolower($controllerName) === "api") {
            $this->error->api_error($e);
        } else {
            $this->error->browser_error($e);
        }
    }
}
