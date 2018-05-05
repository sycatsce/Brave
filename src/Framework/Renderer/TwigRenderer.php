<?php

namespace Framework\Renderer;

use Framework\Renderer\RendererInterface;

class TwigRenderer implements RendererInterface
{

    private $twig;

    private $loader;

    public function __construct(\Twig_Loader_Filesystem $loader, \Twig_Environment $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;
    }
    /**
     * Add a path to include views
     * @param string $namespace
     * @param string|null $path
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path, $namespace);
    }


    /**
     * Render a view
     * You can use namespaces added with addPath by using @
     * $this->render('@characters/show')
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view . '.twig', $params);
    }

    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }
}
