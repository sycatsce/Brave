<?php
namespace App\Characters;

use Framework\Router;
use Framework\Renderer\RendererInterface;
use Framework\Module as GlobalModule;
use App\Characters\Actions\CharactersAction;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Container\ContainerInterface;
use App\Characters\Actions\AdminCharactersAction;

class Module extends GlobalModule
{

    const DEFINITIONS = __DIR__ . '/config.php';

    const MIGRATIONS = __DIR__ . '/db/migrations';

    const SEEDS = __DIR__ . '/db/seeds';

    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(ContainerInterface $container)
    {
        $container->get(RendererInterface::class)->addPath('characters', __DIR__ . '/views');

        $router = $container->get(Router::class);
        $router->get($container->get('characters.prefix'), CharactersAction::class, 'brave.characters');
        $router->get($container->get('characters.prefix').'/{name:[a-z\-]+}-{id:\d+}', CharactersAction::class, 'character.show');

        if ($container->has('admin.prefix')) {
            $prefix = $container->get('admin.prefix');
            $router->get($prefix. '/characters', AdminCharactersAction::class, 'admin.brave.characters');

            $router->get($prefix. '/characters/{id:\d+}', AdminCharactersAction::class, 'admin.character.edit');
            $router->post($prefix. '/characters/{id:\d+}', AdminCharactersAction::class);

            $router->get($prefix. '/characters/create', AdminCharactersAction::class, 'admin.character.create');
            $router->post($prefix. '/characters/create', AdminCharactersAction::class);

            $router->delete($prefix. '/characters/delete/{id:\d+}', AdminCharactersAction::class, 'admin.character.delete');
        }
    }
}
