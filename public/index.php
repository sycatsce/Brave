<?php

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use App\Characters\Module as CharacterModule;
use Framework\Renderer\PHPRenderer;
use Framework\Renderer\TwigRenderer;
use DI\ContainerBuilder;

require dirname(__DIR__) . "../vendor/autoload.php";

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

if (php_sapi_name() !== "cli") {
    $response = $app->run(ServerRequest::fromGlobals());
    \Http\Response\send($response);
}
