<?php

namespace Tests\Framework;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Request;
use Framework\Router;
use GuzzleHttp\Psr7\ServerRequest;


class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private $router;

    public function setUp()
    {
        $this->router = new Router();
    }

    public function testGetMethod()
    {
        $request = new ServerRequest('GET', '/home');
        $this->router->get('/home', function () { return 'homescreen'; }, 'home');
        $route = $this->router->match($request);
        $this->assertEquals('home', $route->getName());
        $this->assertEquals('homescreen', call_user_func($route->getCallable(), [$request]));
    }

    public function testGetMethodWhenURLDoesNotExists()
    {
        $request = new ServerRequest('GET', '/home');
        $this->router->get('/oof', function () { return 'homescreen'; }, 'home');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route->getName());
    }

    public function testGetMethodWithParams()
    {
        $request = new ServerRequest('GET', '/home/mon-slug-8');
        $this->router->get('/home/{slug:[a-z0-9\-]+}-{id:\d+}', function () { return 'homescreen param'; }, 'home.param');
        $this->router->get('/home', function () { return 'homescreen'; }, 'home');
        $route = $this->router->match($request);
        $this->assertEquals('home.param', $route->getName());
        $this->assertEquals('homescreen param', call_user_func($route->getCallable(), [$request]));
        $this->assertEquals(['slug' => 'mon-slug', 'id' => '8'], $route->getParamaters());
    }

}