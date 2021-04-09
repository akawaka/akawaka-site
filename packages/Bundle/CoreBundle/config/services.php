<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
    ;

    $services->load('Mono\\Bundle\\CoreBundle\\', '../src/*');
    $services->load('Mono\\Component\\Core\\', '../../../Component/Core/src/*');

    $configurator->import('services/*');
};
