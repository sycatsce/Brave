<?php
namespace Framework\Router;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;

class MiddlewareApp implements MiddlewareInterface{

    /**
     * @var callable
     */
    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function getCallable(): callable
    {
        return $this->callable;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler = null) : ResponseInterface
    {
        //Implement the process
    }

}