<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->load('Mono\\Bundle\\AoBundle\\', __DIR__.'/../src/*');
    $services->load('Mono\\Component\\Channel\\', __DIR__.'/../../../Component/Channel/src/');
    $services->load('Mono\\Component\\Page\\', __DIR__.'/../../../Component/Page/src/');
    $services->load('Mono\\Component\\Article\\', __DIR__.'/../../../Component/Article/src/');
    $services->load('Mono\\Component\\AdminSecurity\\', __DIR__.'/../../../Component/AdminSecurity/src/');

    $configurator->import('services/*');
};
