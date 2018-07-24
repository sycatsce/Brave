<?php

use App\Admin\Module as AdminModule;
use function \DI\factory;
use function \DI\autowire;
use function \DI\get;

return [
    'admin.prefix' => '/admin',
    AdminModule::class => autowire()->constructorParameter('prefix', get('admin.prefix'))

];
