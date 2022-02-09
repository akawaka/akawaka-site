<?php

declare(strict_types=1);

use App\Context\Front\Contact\Infrastructure\Mailer\SymfonyMailer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $containerConfigurator->import('services/');

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\', __DIR__.'/../src/App/')
        ->exclude([
            __DIR__.'/../src/Kernel.php'
        ]);

    $services->load('App\\UI\\Admin\\Controller\\',
        __DIR__.'/../src/App/UI/Admin/Controller/**/Action.php')
        ->tag('controller.service_arguments');

    $services->load('App\\UI\\Front\\Controller\\',
        __DIR__.'/../src/App/UI/Front/Controller/**/Action.php')
        ->tag('controller.service_arguments');

    $services->set(SymfonyMailer::class)
        ->bind('$senderEmail', '%env(resolve:SENDER_EMAIL)%')
        ->bind('$senderName','%env(resolve:SENDER_NAME)%');

    $services
        ->set(App\Context\Admin\Space\Domain\Create\DataPersister\Factory\Builder::class)
        ->alias(
            Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister\Factory\BuilderInterface::class,
            App\Context\Admin\Space\Domain\Create\DataPersister\Factory\Builder::class
        )
        ->set(App\Context\Admin\Space\Infrastructure\Persistence\DBAL\CreatePersisterRepository::class)
        ->alias(
            Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister\CreatePersisterInterface::class,
            App\Context\Admin\Space\Infrastructure\Persistence\DBAL\CreatePersisterRepository::class
        );

    $services
        ->set(App\Context\Admin\Space\Domain\Update\DataPersister\Factory\Builder::class)
        ->alias(
            Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\Factory\BuilderInterface::class,
            App\Context\Admin\Space\Domain\Update\DataPersister\Factory\Builder::class
        )
        ->set(App\Context\Admin\Space\Infrastructure\Persistence\DBAL\UpdatePersisterRepository::class)
        ->alias(
            Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\UpdatePersisterInterface::class,
            App\Context\Admin\Space\Infrastructure\Persistence\DBAL\UpdatePersisterRepository::class
        );

    $services
        ->set(App\Context\Admin\Space\Domain\View\DataProvider\Factory\Builder::class)
        ->alias(
            Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\Factory\BuilderInterface::class,
            App\Context\Admin\Space\Domain\View\DataProvider\Factory\Builder::class
        );

    $services
        ->set(App\Context\Admin\Space\Domain\Browse\DataProvider\Factory\Builder::class)
        ->alias(
            Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Browse\DataProvider\Factory\BuilderInterface::class,
            App\Context\Admin\Space\Domain\Browse\DataProvider\Factory\Builder::class
        );
};
