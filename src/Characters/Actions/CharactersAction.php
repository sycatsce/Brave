<?php

namespace App\Characters\Actions;

use Psr\Http\Message\ServerRequestInterface;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use Framework\Helpers\RouterHelper;
use App\Characters\Repository\CharactersRepository;

class CharactersAction
{

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var CharactersRepository
     */
    private $charactersRepository;

    use RouterHelper;

    public function __construct(RendererInterface $renderer, Router $router, CharactersRepository $charactersRepository)
    {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->charactersRepository = $charactersRepository;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        if ($request->getAttribute('id')) {
            return $this->characterShow($request);
        } else {
            return $this->showCharacters();
        }
    }
    public function showCharacters(): string
    {
        $characters = $this->charactersRepository->getCharacters();
        return $this->renderer->render('@characters' . DIRECTORY_SEPARATOR . 'index', compact('characters'));
    }

    public function characterShow(ServerRequestInterface $request)
    {
        $attributes = $request->getAttributes();

        $character = $this->charactersRepository->getCharacter($attributes['id']);

        /* If the name in the URL doesn't match the ID, redirect to the correct page */
        if (strtolower(preg_replace('/(&| )/', '-', $character['name'])) !== $request->getAttribute('name')) {
            return $this->redirect('character.show', [
                'name' => strtolower(preg_replace('/(&| )/', '-', $character['name'])),
                'id' => $character['id']
            ]);
        }
        return $this->renderer->render('@characters' . DIRECTORY_SEPARATOR . 'show', $character);
    }
}
