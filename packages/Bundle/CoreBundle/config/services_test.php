<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
    ;

    $services->load('Black\\Component\\Channel\\', '../../../Component/Channel/src/*');
    $services->load('Black\\Component\\Channel\\Tests\\Behat\\', '../../../Component/Channel/tests/Behat/*');
};
