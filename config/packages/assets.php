<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'assets' => [
            'packages' => [
                'front' => [
                    'json_manifest_path' => '%kernel.project_dir%/public/build/front/manifest.json'
                ],
                'admin' => [
                    'json_manifest_path' => '%kernel.project_dir%/public/build/admin/manifest.json'
                ]
            ]
        ]
    ]);
};
