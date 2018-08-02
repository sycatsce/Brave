<?php

namespace App\Admin\Actions;

use Psr\Http\Message\ServerRequestInterface;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use Framework\Helpers\RouterHelper;

class AdminAction
{

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var Router
     */
    private $router;

    use RouterHelper;

    public function __construct(RendererInterface $renderer, Router $router)
    {
        $this->renderer = $renderer;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        if ('/' == $request->getUri()->getPath()) {
            return $this->home($request);
        }
    }

    public function home(ServerRequestInterface $request)
    {
        return $this->renderer->render('@admin' . DIRECTORY_SEPARATOR . 'home');
    }
}
