<?php

namespace Framework\Helpers;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

trait RouterHelper
{
    public function redirect(string $path, array $params = []) : ResponseInterface
    {
        $uri = $this->router->generateUri($path, $params);
        return (new Response())
            ->withStatus(301)
            ->withHeader('location', $uri);
    }
}
