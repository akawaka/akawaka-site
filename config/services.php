<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $containerConfigurator->import('services/');

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\', __DIR__.'/../src/App/')
        ->exclude([
            __DIR__ . '/../src/App/CMS/Infrastructure/DependencyInjection/',
            __DIR__.'/../src/Kernel.php'
        ]);

    $services->load('Mono\\Component\\AdminSecurity\\',
        __DIR__.'/../src/Mono/Component/AdminSecurity/src/');

    $services->load('App\\UI\\Admin\\Controller\\',
        __DIR__.'/../src/App/UI/Admin/Controller/**/Action.php')
        ->tag('controller.service_arguments');

    $services->load('App\\UI\\Front\\Controller\\',
        __DIR__.'/../src/App/UI/Front/Controller/**/Action.php')
        ->tag('controller.service_arguments');
};
