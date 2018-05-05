<?php

require "../vendor/autoload.php";
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use App\Characters\Module as CharacterModule;
use Framework\Renderer\PHPRenderer;
use Framework\Renderer\TwigRenderer;
use DI\ContainerBuilder;

$modules = [
    CharacterModule::class
];

$builder = new ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__) . '/config.php');
foreach ($modules as $module) {
    if ($module::DEFINITIONS) {
        $builder->addDefinitions($module::DEFINITIONS);
    }
}
$builder->addDefinitions(dirname(__DIR__) . '/config/config.php');

$container = $builder->build();

$app = new App($container, $modules);

$response = $app->run(ServerRequest::fromGlobals());
\Http\Response\send($response);
