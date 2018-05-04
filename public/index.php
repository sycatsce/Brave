<?php

require "../vendor/autoload.php";
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use App\Characters\Module as CharacterModule;

$app = new App([
    CharacterModule::class
]);

$response = $app->run(ServerRequest::fromGlobals());
\Http\Response\send($response);
