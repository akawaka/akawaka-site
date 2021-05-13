<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Mono\Bundle\AoBundle\CMS\Infrastructure\Mailer\SymfonyMailer;
use Mono\Bundle\AoBundle\Infrastructure\Listener\RequestListener;
use Twig\Environment;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services
        ->set(RequestListener::class)
        ->tag('kernel.event_listener');
};
