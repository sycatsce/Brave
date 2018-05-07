<?php

namespace Framework;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;

class App
{

    /**
     * List of modules
     * @var array
     */
    private $modules = [];

    /**
     * Router
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * App constructor
     * @param ContainerInterface $container
     * @param string[] $modules liste des modules à charger
     */
    public function __construct(ContainerInterface $container, array $modules = [])
    {
        $this->container = $container;
        foreach ($modules as $module) {
            $this->modules[] = $container->get($module);
        }
    }
    public function run(ServerRequestInterface $request): ResponseInterface
    {

        $uri = $request->getUri()->getPath();

        if (!empty($uri) && $uri[-1] === "/") {
            $response = (new Response())
            ->withStatus(301)
            ->withHeader('Location', substr($uri, 0, -1));
            return $response;
        }

        $route = $this->container->get(Router::class)->match($request);
        if (is_null($route)) {
            return new Response(404, [], '<h1>Erreur 404</h1>');
        }
        
        $params = $route->getParameters();
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        $callback = $route->getCallable();
        if (is_string($callback)) {
            $callback = $this->container->get($callback);
        }
        
        $response = call_user_func_array($callback, [$request]);
        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception('Unknown response');
        }
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
