<?php

namespace App\Helpers;

class Router
{
    private $routes = [];
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get($uri, $action, $middleware = null)
    {
        // Converte {id} para uma expressão regular (captura um número)
        $uriPattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $this->normalizeUri($uri));
        $this->routes['GET'][$uriPattern] = ['action' => $action, 'middleware' => $middleware];
    }

    public function post($uri, $action, $middleware = null)
    {
        $this->routes['POST'][$this->normalizeUri($uri)] = ['action' => $action, 'middleware' => $middleware];
    }

    public function patch($uri, $action, $middleware = null)
    {
        $uriPattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $this->normalizeUri($uri));
        $this->routes['PATCH'][$uriPattern] = ['action' => $action, 'middleware' => $middleware];
    }

    public function delete($uri, $action, $middleware = null)
    {
        $uriPattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $this->normalizeUri($uri));
        $this->routes['DELETE'][$uriPattern] = ['action' => $action, 'middleware' => $middleware];
    }

    public function dispatch()
    {
        try {

            $uri    = $this->normalizeUri($_SERVER['REQUEST_URI']);
            $method = $_SERVER['REQUEST_METHOD'];

            foreach ($this->routes[$method] as $routePattern => $route) {

                if (preg_match('#^' . $routePattern . '$#', $uri, $matches)) {

                    array_shift($matches);
    
                    if (isset($route['middleware']) && $route['middleware']) {
                        $middleware = $route['middleware'];

                        if (class_exists($middleware[0])) {
                            $middlewareInstance = new $middleware[0]();
                            $middlewareMethod   = $middleware[1];
    
                            $middlewareInstance->$middlewareMethod($_SERVER, function($request) use ($route, $matches) {
                                $this->callAction($route['action'], $matches);
                            });
                        } else {
                            throw new \Exception("Middleware {$middleware[0]} não encontrado.");
                        }
                    } else {
                        $this->callAction($route['action'], $matches);
                    }
    
                    return;
                }
            }

            throw new \Exception("Página não encontrada.", 404);

        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function callAction($action, $params)
    {
        [$controller, $method] = $action;
        $controllerInstance = new $controller($this->db);

        call_user_func_array([$controllerInstance, $method], $params ?? []);
    }

    private function normalizeUri($uri)
    {
        return trim(parse_url($uri, PHP_URL_PATH), '/');
    }
}
