<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('mono_ui', [
        'events' => [
            'mono.admin' => [
                'blocks' => [
                    'test' => [
                        'template' => 'test.html.twig'
                    ]
                ],
            ]
        ]
    ]);
};
