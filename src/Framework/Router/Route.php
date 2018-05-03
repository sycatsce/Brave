<?php

namespace Framework\Router;


/**
 * Class Route
 * Matched routes
 */
class Route
{

    /**
     * @var name
     */
    private $name;

    /**
     * @var Callable
     */
    private $callable;

    /**
     * @var array
     */
    private $parameters;


    public function __construct(string $name, callable $callable, array $parameters)
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return callable
     */
    public function getCallable(): callable
    {
        return $this->callable;
    }

    /**
     * Get URL parameters
     * @return string[]
     */
    public function getParamaters(): array
    {
        return $this->parameters;
    }
}