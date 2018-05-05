<?php

require "../vendor/autoload.php";
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use App\Characters\Module as CharacterModule;
use Framework\Renderer\PHPRenderer;
use Framework\Renderer\TwigRenderer;

$renderer = new TwigRenderer(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');
$renderer->addPath(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');

$app = new App([
    CharacterModule::class
], [
    'renderer' => $renderer
]);

$response = $app->run(ServerRequest::fromGlobals());
\Http\Response\send($response);
