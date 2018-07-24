<?php

use Framework\Renderer\TwigRenderer;
use Psr\Container\ContainerInterface;
use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;
use function \DI\{factory, autowire, get};
use Framework\Router\RouterTwigExtension;

return [
    'database.username' => 'root',
    'database.host' => '192.168.99.100',
    'database.password' => 'password',
    'database.name' => 'sycatsce',
    'views.path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views',
    'twig.extensions' => [
        get(RouterTwigExtension::class)
    ],
    RendererInterface::class => factory(TwigRendererFactory::class),
    Router::class => autowire(),
];