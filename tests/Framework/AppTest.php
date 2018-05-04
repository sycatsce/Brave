<?php

namespace Tests\Framework;

use PHPUnit\Framework\TestCase;
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use App\Characters\Module as CharactersModule;
use GuzzleHttp\Psr7\Response;
use Tests\Framework\Modules\ErroredModule;

class AppTest extends TestCase
{

    public function testRedirectTrailingSlash()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/demoslash/');
        $response = $app->run($request);
        $this->assertContains('/demoslash', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    /*public function testHomePage()
    {

        $app = new App();
        $request = new ServerRequest('GET', '/home');
        $response = $app->run($request);
        $this->assertEquals('<h1>Home</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }*/

    public function testCharactersPage()
    {
        $app = new App([
            CharactersModule::class
        ]);

        $request = new ServerRequest('GET', '/brave/characters');
        $response = $app->run($request);
        $this->assertContains('<h1> Every characters </h1>', (string)$response->getBody());

        $requestChar = new ServerRequest('GET', '/brave/character/ichigo-29');
        $responseChar = $app->run($requestChar);
        $this->assertContains('<h1> Character 29 : ichigo</h1>', (string)$responseChar->getBody());
    }

    /*public function testNoResponseSent(){

        $app = new App([
            ErroredModule::class
        ]);

    }*/

    public function test404error()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/fhbdn');
        $response = $app->run($request);
        $this->assertEquals('<h1>Erreur 404</h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
