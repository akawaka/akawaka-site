<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
    ;

    $services->load('Mono\\Component\\AdminSecurity\\', '../../../Component/AdminSecurity/src/*');
    $services->load('Mono\\Component\\AdminSecurity\\Tests\\Behat\\', '../../../Component/AdminSecurity/tests/Behat/*');

    $services->load('Mono\\Component\\Article\\', '../../../Component/Article/src/*');
    $services->load('Mono\\Component\\Article\\Tests\\Behat\\', '../../../Component/Article/tests/Behat/*');

    $services->load('Mono\\Component\\Channel\\', '../../../Component/Channel/src/*');
    $services->load('Mono\\Component\\Channel\\Tests\\Behat\\', '../../../Component/Channel/tests/Behat/*');

    $services->load('Mono\\Component\\Core\\', '../../../Component/Core/src/*');
    $services->load('Mono\\Component\\Corel\\Tests\\Behat\\', '../../../Component/Corel/tests/Behat/*');

    $services->load('Mono\\Component\\Page\\', '../../../Component/Core/src/*');
    $services->load('Mono\\Component\\Pagel\\Tests\\Behat\\', '../../../Component/Page/tests/Behat/*');
};
