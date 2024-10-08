<?php

namespace App\Libraries;

use App\Exceptions\ValidationException;

class Request
{
    private string 
        $method = '',
        $uri    = '';
    private array $inputs = [];

    public function __construct()
    {
        $this->setMethod($_SERVER['REQUEST_METHOD']);
        $this->setUri($_SERVER['REQUEST_URI']);
        $this->handleInput();
    }

    public function handleInput()
    {
        switch ($this->getMethod()) {
            case 'GET':
                $this->setInputs($_GET);
                break;
            
            case 'POST':
                $this->setInputs($_POST);
                break;
            
            default:
                break;
            
        }
    }

    private function setInputs(array $inputs)
    {
        $this->inputs = $inputs;
    }

    public function getInput(string $name)
    {
        return $this->inputs[$name] ?? null;
    }

    public function allInput()
    {
        return $this->inputs;
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function validate(array $data, array $rules)
    {
        try {
            return Validation::validate($data, $rules);
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
