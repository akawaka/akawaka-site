<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Mono\Bundle\AoBundle\CMS\Infrastructure\Mailer\SymfonyMailer;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services
        ->set(SymfonyMailer::class)
        ->args([
            '$senderEmail' => '%env(resolve:SENDER_EMAIL)%',
            '$senderName' => '%env(resolve:SENDER_NAME)%',
        ])
    ;
};
