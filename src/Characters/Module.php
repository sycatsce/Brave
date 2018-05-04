<?php
namespace App\Characters;

use Framework\Router;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class Module
{

    public function __construct(Router $router)
    {
        $router->get('/brave/characters', [$this, 'braveCharacters'], 'brave.characters');
        $router->get('/brave/character/{name:[a-z\-]+}-{id:\d+}', [$this, 'characterShow'], 'character.show');
    }

    public function braveCharacters(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, [], '<h1> Every characters </h1>');
    }

    public function characterShow(ServerRequestInterface $request): Response
    {
        return new Response(200, [], '<h1> Character '.$request->getAttribute('id').' : ' . $request->getAttribute('name') . '</h1>');
    }
}
