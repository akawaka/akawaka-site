<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Mono\Component\Core\Infrastructure\Workflow\DomainMarkingStore;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services();

    $services
        ->set('domain.marking.store', DomainMarkingStore::class)
        ->args([
            true,
            'state',
        ]);
};
