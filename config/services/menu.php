<?php

declare(strict_types=1);

use App\UI\Admin\Menu\CMSMenuBuilder;
use App\UI\Admin\Menu\MainMenuBuilder;
use App\UI\Admin\Menu\SecurityMenuBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services()
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
