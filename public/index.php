<?php

require "../vendor/autoload.php";
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;

$app = new App([
    HomeModule::class
]);

$response = $app->run(ServerRequest::fromGlobals());
\Http\Response\send($response);
