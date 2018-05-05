<?php
namespace App\Characters;

use Framework\Router;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Framework\Renderer\RendererInterface;

class Module
{
    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('characters', __DIR__ . '/views');

        $router->get('/brave/characters', [$this, 'braveCharacters'], 'brave.characters');
        $router->get('/brave/characters/{name:[a-z\-]+}-{id:\d+}', [$this, 'characterShow'], 'character.show');
    }

    public function braveCharacters(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@characters' . DIRECTORY_SEPARATOR . 'index');
    }

    public function characterShow(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@characters' . DIRECTORY_SEPARATOR . 'show', $request->getAttributes());
    }
}
