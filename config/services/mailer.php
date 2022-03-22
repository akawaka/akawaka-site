<?php

declare(strict_types=1);


use App\Shared\Infrastructure\Mailer\SymfonyMailer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services()
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
