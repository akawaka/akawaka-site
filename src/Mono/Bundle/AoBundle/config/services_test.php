<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->load('Mono\\Tests\\Bundle\\AoBundle\\', __DIR__.'/../tests/');
    $services->load('Mono\\Tests\\Component\\Page\\', __DIR__.'/../../../Component/Page/tests/');
    $services->load('Mono\\Tests\\Component\\Article\\', __DIR__.'/../../../Component/Article/tests/');
};
