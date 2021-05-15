<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\UI\Admin\Menu\CMSMenuBuilder;
use App\UI\Admin\Menu\MainMenuBuilder;
use App\UI\Admin\Menu\SecurityMenuBuilder;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->public()
    ;

    $services
        ->set('mono.admin.menu_builder.main', MainMenuBuilder::class)
        ->tag('knp_menu.menu_builder', [
            'method' => 'createMenu',
            'alias' => 'mono.admin.main',
        ])
    ;

    $services
        ->set('mono.admin.menu_builder.cms', CMSMenuBuilder::class)
        ->tag('knp_menu.menu_builder', [
            'method' => 'createMenu',
            'alias' => 'mono.admin.cms.sidebar',
        ])
    ;

    $services
        ->set('mono.admin.menu_builder.security', SecurityMenuBuilder::class)
        ->tag('knp_menu.menu_builder', [
            'method' => 'createMenu',
            'alias' => 'mono.admin.security.sidebar',
        ])
    ;
};
