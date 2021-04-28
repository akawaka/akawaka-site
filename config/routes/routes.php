<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    $routingConfigurator->add('admin_logout', '/admin/logout')
        ->methods(['GET'])
    ;

    $routingConfigurator->import('front/routes.php');
};
