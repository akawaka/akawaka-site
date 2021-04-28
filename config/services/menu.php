<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set('admin.sidebar_builder', 'App\UI\Admin\Common\Menu\SidebarBuilder')
        ->args([service('knp_menu.factory')])
        ->tag('knp_menu.menu_builder', ['method' => 'createMenu', 'alias' => 'sidebar'])
    ;
};
