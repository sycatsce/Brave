<?php

namespace Framework\Twig;

use Pagerfanta\Pagerfanta;
use Pagerfanta\View\DefaultView;
use Framework\Router;

class PagerFantaExtension extends \Twig_Extension
{

    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('paginate', [$this, 'paginate'], ['is_safe' => ['html']])
        ];
    }

    public function paginate(Pagerfanta $paginatedResults, string $route, array $queryArgs = []) : string
    {
        $view = new DefaultView();
        return $view->render($paginatedResults, function ($page) use ($route, $queryArgs) {

            if ($page > 1) {
                $queryArgs['p'] = $page;
            }

            return $this->router->generateUri($route, [], $queryArgs);
        });
    }
}
