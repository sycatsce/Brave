<?php

namespace Framework\Renderer;

interface RendererInterface
{
    /**
     * Add a path to include views
     * @param string $namespace
     * @param string|null $path
     */
    public function addPath(string $namespace, ?string $path = null): void;


    /**
     * Render a view
     * You can use namespaces added with addPath by using @
     * $this->render('@characters/show')
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string;

    public function addGlobal(string $key, $value): void;
}
