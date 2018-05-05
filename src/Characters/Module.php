<?php
namespace App\Characters;

use Framework\Router;
use Framework\Renderer\RendererInterface;
use Framework\Module as GlobalModule;
use App\Characters\Actions\CharactersAction;
use Psr\Http\Message\ServerRequestInterface;

class Module extends GlobalModule
{

    const DEFINITIONS = __DIR__ . '/config.php';

    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('characters', __DIR__ . '/views');

        $router->get($prefix, CharactersAction::class, 'brave.characters');
        $router->get($prefix.'/{name:[a-z\-]+}-{id:\d+}', [$this, 'characterShow'], 'character.show');
    }

    public function characterShow(ServerRequestInterface $request): string
    {
        return $this->renderer->render('@characters' . DIRECTORY_SEPARATOR . 'show', $request->getAttributes());
    }
}
