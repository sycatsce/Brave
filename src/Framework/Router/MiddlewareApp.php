<?php
namespace Framework\Router;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;

class MiddlewareApp implements MiddlewareInterface
{

    /**
     * @var callable|string
     */
    private $callable;

    public function __construct($callable)
    {
        $this->callable = $callable;
    }

    public function getCallable()
    {
        return $this->callable;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler = null) : ResponseInterface
    {
        //Implement the process
    }
}
