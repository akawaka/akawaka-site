<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('webpack_encore', [
        'output_path' => false,
        'script_attributes' => [
            'defer' => true
        ],
        'preload' => true,
        'strict_mode' => true,
        'builds' => [
            'front' => '%kernel.project_dir%/public/build/front',
            'admin' => '%kernel.project_dir%/public/build/admin'
        ]
    ]);
};
