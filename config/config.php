<?php

use Framework\Renderer\TwigRenderer;
use Psr\Container\ContainerInterface;
use Framework\Renderer\RendererInterface;
use Framework\Renderer\TwigRendererFactory;
use Framework\Router;
use function \DI\{factory, autowire, get};
use Framework\Router\RouterTwigExtension;
use Framework\Twig\PagerFantaExtension;
use App\Characters\Twig\TwigCharacterExtension;

return [
    'database.username' => 'root',
    'database.host' => '192.168.99.100',
    'database.password' => 'password',
    'database.name' => 'sycatsce',
    'views.path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views',
    'assets' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'assets',
    'twig.extensions' => [
        get(RouterTwigExtension::class),
        get(PagerFantaExtension::class),
        get(TwigCharacterExtension::class)
    ],
    RendererInterface::class => factory(TwigRendererFactory::class),
    Router::class => autowire(),
    \PDO::class => function(ContainerInterface $container){
        return new PDO('mysql:host=' . $container->get('database.host') . ';dbname=' . $container->get('database.name'), 
            $container->get('database.username'), 
            $container->get('database.password'),
            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
        );
    }
];