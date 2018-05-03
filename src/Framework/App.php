<?php

namespace Framework;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class App
{

    private $modules = [];

    /**
     * App constructor
     * @param string[] $modules liste des modules à charger
     */
    public function __construct(array $modules = [])
    {
        $router = new Router();
        foreach ($modules as $module) {
            $this->modules[] = new $module($router);
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
        if ($uri === '/home') {
            return new Response(200, [], '<h1>Home</h1>');
        }

        return new response(404, [], '<h1>Erreur 404</h1>');
    }
}
