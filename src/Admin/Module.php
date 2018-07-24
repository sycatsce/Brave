<?php
namespace App\Admin;

use Framework\Router;
use Framework\Renderer\RendererInterface;
use Framework\Module as GlobalModule;
use App\Admin\Actions\AdminAction;
use Psr\Http\Message\ServerRequestInterface;

class Module extends GlobalModule
{

    const DEFINITIONS = __DIR__ . '/config.php';

    const MIGRATIONS = __DIR__ . '/db/migrations';

    const SEEDS = __DIR__ . '/db/seeds';

    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('admin', __DIR__ . '/views');

        $router->get('/', AdminAction::class, 'homepage');
    }
}
