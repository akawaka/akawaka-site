<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->bind('$env', '%kernel.environment%')
    ;

    $services->load('Mono\\Bundle\\UIBundle\\', __DIR__.'/../src/*');
    $configurator->import('services/*');
};
