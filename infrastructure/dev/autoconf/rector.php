<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [__DIR__ . '/src', __DIR__ . '/tests']);
    $parameters->set(Option::SKIP, [__DIR__ . '/src/Migrations/*']);
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_80);

    $parameters->set(
        Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER,
        __DIR__ .  '/var/cache/dev/App_KernelDevDebugContainer.xml')
    ;

    $containerConfigurator->import(SymfonySetList::SYMFONY_CODE_QUALITY);
    $containerConfigurator->import(SymfonySetList::SYMFONY_60);

    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::SAFE_07);
};
