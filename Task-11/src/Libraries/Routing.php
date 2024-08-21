<?php

namespace App\Libraries;

use Closure;
use ReflectionClass;

class Routing
{
    protected array $routes = [];
    
    public function add(
        string $method,
        string $path,
        Closure|array $callback)
    {
        $this->routes[] = [
            'method'   => $method,
            'path'     => $path,
            'callback' => $callback,
        ];
    }

    /**
     * @throws \ReflectionException
     */
    public function run()
    {
        $request = new Request();

        foreach ($this->routes as $route) {
            if ($route['method'] != $request->getMethod()) {
                continue;
            }

            $regexPattern = preg_replace_callback('/:\w+/', function ($params) {
                    return '([^/]+)';
                },
                $route['path']
            );

            if (preg_match("#^{$regexPattern}$#", $request->getUri(), $params)) {
                array_shift($params);
                
                if (is_callable($route['callback'])) {
                    return call_user_func_array($route['callback'], $params);
                }

                list($controller, 
                $methodName)         = $route['callback'];
                $controller          = new $controller;
                $reflection          = new ReflectionClass($controller);
                $availableParameters = $reflection->getMethod($methodName);
                $hasRequest          = false;

                foreach ($availableParameters->getParameters() as $parameter) {
                    $paramType = $parameter->getType();

                    if ($paramType?->getName() === Request::class) {
                        $hasRequest = true;
                    }
                }

                if ($hasRequest) {
                    $params = [
                        $request,
                        ...$params,
                    ];   
                } 

                return $controller->{$methodName}(...$params);
            }
        }

        header('HTTP/1.1 404 Not Found');

        die('404 Not Found');
    }
}