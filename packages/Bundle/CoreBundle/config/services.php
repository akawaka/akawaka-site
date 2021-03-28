<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
    ;

    $services->load('Black\\Component\\Core\\', '../../../Component/Core/src/*');
    $services->load('Black\\Bundle\\CoreBundle\\', '../src/*');

    $services->load('Black\\Component\\Channel\\', '../../../Component/Channel/src/*');

    $configurator->import('services/*');
};
