<?php
namespace Tests\Framework\Modules;

use Framework\Router;

class ErroredModule
{

    public function __contruct(Router $router)
    {
        $router->get('/erroredModule', function () {
            return new \stdClass();
        }, 'erroredModule');
    }
}
