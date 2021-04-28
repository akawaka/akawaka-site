<?php

declare(strict_types=1);

use App\UI\Front\Controller\Contact;
use App\UI\Front\Controller\Index;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    $routingConfigurator->add('index', '/')
        ->controller(Index\Action::class)
        ->methods(['GET'])
    ;

    $routingConfigurator->add('contact', '/contact')
        ->controller(Contact\Action::class)
        ->methods(['GET', 'POST'])
    ;
};
