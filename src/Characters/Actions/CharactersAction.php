<?php

namespace App\Characters\Actions;

use Psr\Http\Message\ServerRequestInterface;
use Framework\Renderer\RendererInterface;

class CharactersAction
{

    /**
     * @var RendererInterface
     */
    private $renderer;
    
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        return $this->showCharacters();
    }
    public function showCharacters(): string
    {
        return $this->renderer->render('@characters' . DIRECTORY_SEPARATOR . 'index');
    }
}
