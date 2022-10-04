<?php

use DI\ContainerBuilder;
use Project\System\Infrastructure\Persistence\ConnectionCreator;
use Project\System\Infrastructure\User\UserRepository;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(
    [
        UserRepository::class => function(){
            return (new UserRepository());
        },
        ConnectionCreator::class => function(){
            return (new ConnectionCreator())->createConnection();
        }
    ]
);

return $containerBuilder->build();