<?php

namespace Framework\Renderer;

use Psr\Container\ContainerInterface;
use Framework\Router\RouterTwigExtension;

class TwigRendererFactory
{

    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        $loader = new \Twig_Loader_Filesystem($container->get('views.path'));
        $twig = new \Twig_Environment($loader);

        if ($container->has('twig.extensions')) {
            foreach ($container->get('twig.extensions') as $extension) {
                $twig->addExtension($extension);
            }
        }
        return new TwigRenderer($loader, $twig);
    }
}
