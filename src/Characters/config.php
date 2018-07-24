<?php

use App\Characters\Module as CharactersModule;
use function \DI\factory;
use function \DI\autowire;
use function \DI\get;

return [
    'characters.prefix' => '/characters',
    CharactersModule::class => autowire()->constructorParameter('prefix', get('characters.prefix'))

];
