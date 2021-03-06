<?php

namespace Framework;

use Framework\Router\Route;
use Psr\Http\Message\ServerRequestInterface;
use League\Route\RouteCollection;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;
use Framework\Router\MiddlewareApp;

/**
 * Registers and matches routes
 */
class Router
{
    /**
     * @var FastRouteRouter
     */
    private $router;

    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    /**
     * @param string path
     * @param callable|string $callable
     * @param string $name
     */
    public function get(string $path, $callable, ?string $name = null)
    {
        $route = new ZendRoute($path, new MiddlewareApp($callable), ['GET'], $name);
        $this->router->addRoute($route);
    }

        /**
     * @param string path
     * @param callable|string $callable
     * @param string $name
     */
    public function post(string $path, $callable, ?string $name = null)
    {
        $route = new ZendRoute($path, new MiddlewareApp($callable), ['POST'], $name);
        $this->router->addRoute($route);
    }

    /**
     * @param string path
     * @param callable|string $callable
     * @param string $name
     */
    public function delete(string $path, $callable, ?string $name = null)
    {
        $route = new ZendRoute($path, new MiddlewareApp($callable), ['DELETE'], $name);
        $this->router->addRoute($route);
    }

    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request): ?Route
    {
        $result = $this->router->match($request);

        if ($result->isSuccess()) {
            return new Route(
                $result->getMatchedRouteName(),
                $result->getMatchedRoute()->getMiddleware()->getCallable(),
                $result->getMatchedParams()
            );
        }
        return null;
    }

    public function generateUri(string $routeName, array $params = [], array $queryParams = []) : ?string
    {
        $uri = $this->router->generateUri($routeName, $params);
        if (!empty($queryParams)) {
            return $uri . '?' .http_build_query($queryParams);
        }
        return $uri;
    }
}
