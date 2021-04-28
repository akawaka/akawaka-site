<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    $routingConfigurator->import('../../src/App/UI/Front/Controller/**/Action', 'annotation');

    $routingConfigurator->import('../../src/App/UI/Admin/Controller/**/Action.php', 'annotation');

    $routingConfigurator->import('../../src/App/Kernel.php', 'annotation');
};
