<?php
namespace App\Characters;

use Framework\Router;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Framework\Renderer;

class Module
{
    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(Router $router)
    {
        $this->renderer = new Renderer();
        $this->renderer->addPath('characters', __DIR__ . '/views');

        $router->get('/brave/characters', [$this, 'braveCharacters'], 'brave.characters');
        $router->get('/brave/character/{name:[a-z\-]+}-{id:\d+}', [$this, 'characterShow'], 'character.show');
    }

    public function braveCharacters(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@characters/index');
    }

    public function characterShow(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@characters/show');
    }
}
