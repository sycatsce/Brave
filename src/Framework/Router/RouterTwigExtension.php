<?php

namespace Framework\Router;

use Framework\Router;

/**
 * Add an extension for twig
 * If a module need its own extensions, I can add it in the module's config file for the containter
 * key : twig.extensions
 */
class RouterTwigExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('path', [$this, 'pathFor']),
            new \Twig_SimpleFunction('adjustName', [$this, 'adjustName'])
        ];
    }

    public function pathFor(string $path, array $params = []): string
    {
        return $this->router->generateUri($path, $params);
    }

    public function adjustName(string $name): string
    {
        return strtolower(preg_replace('/(&| )/', '-', $name));
    }
}
