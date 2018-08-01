<?php

namespace App\Characters\Actions;

use Psr\Http\Message\ServerRequestInterface;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use Framework\Helpers\RouterHelper;
use App\Characters\Repository\CharactersRepository;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

class AdminCharactersAction
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

        if ($request->getMethod() == "DELETE") {
            return $this->delete($request);
        }
        if (substr((string)$request->getUri(), -6) == 'create') {
            return $this->create($request);
        }
        if ($request->getAttribute('id')) {
            return $this->editCharacter($request);
        } else {
            return $this->showCharacters($request);
        }
    }
    public function showCharacters(ServerRequestInterface $request): string
    {
        $params = $request->getQueryParams();
        $characters = $this->charactersRepository->getCharacters(12, $params['p'] ?? 1);
        return $this->renderer->render('@characters/admin/index', compact('characters'));
    }

    public function editCharacter(ServerRequestInterface $request): string
    {
        $character = $this->charactersRepository->getCharacter($request->getAttribute('id'));

        if ( $request->getMethod() === 'POST' ) {
            $params = array_filter($request->getParsedBody(), function($key) {
                return in_array($key, ['name', 'id_version', 'id_attribute', 'id_affiliation', 'id_affiliation2', 'id_soultrait', 'id_killer', 'id_killer2', 'description']);
            }, ARRAY_FILTER_USE_KEY);
            $this->charactersRepository->update($character->id, $params);

            $stats = array_filter($request->getParsedBody(), function($key) {
                return in_array($key, ['stamina1', 'attack2', 'defense3', 'spiritual_pressure4', 'focus5']);
            }, ARRAY_FILTER_USE_KEY);
            $this->charactersRepository->updateStats($character->id, $stats);
            return $this->renderer->render('@characters/show', compact('character'));
        }
        return $this->renderer->render('@characters/admin/edit', compact('character'));

    }

    public function create(ServerRequestInterface $request): string
    {
        if ( $request->getMethod() === 'POST' ) {

            $filter = ['name', 'nickname', 'id_attribute', 'id_affiliation', 'id_soultrait', 'id_killer', 'description', 'release_date'];
            $body = $request->getParsedBody();

            if ($body['id_affiliation2'] !== "" && $body['id_affiliation'] !== $body['id_affiliation2']) { $filter[] = 'id_affiliation2'; }
            if ($body['id_killer2'] !== "" && $body['id_killer'] !== $body['id_killer2']) { $filter[] = 'id_killer2'; }
            if ($body['id_version'] !== "") { $filter[] = 'id_version'; }



            $params = array_filter($request->getParsedBody(), function($key) use ($filter){
                return in_array($key, $filter);
            }, ARRAY_FILTER_USE_KEY);

            $params = array_merge($params, [
                'created_at' => date('Y-m-d H:i:s'),
                'image' => $params['nickname'] . '.png'
            ]);

            $stats = array_filter($request->getParsedBody(), function($key) {
                return in_array($key, ['stamina1', 'attack2', 'defense3', 'spiritual_pressure4', 'focus5']);
            }, ARRAY_FILTER_USE_KEY);
            $this->charactersRepository->create($params, $stats);
            $this->redirect('brave.characters');
        }
        return $this->renderer->render('@characters/admin/create', compact('character'));
    }

    public function delete(ServerRequestInterface $request){
        if( $this->charactersRepository->delete($request->getAttribute('id')) ){
            return $this->redirect('admin.brave.characters');
        }
    }
}
