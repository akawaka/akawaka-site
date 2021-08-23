<?php

declare(strict_types=1);

use App\Infrastructure\Theme\ThemeContext;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('sylius_theme', [
        'sources' => [
            'filesystem' => null,
        ],
        'context' => ThemeContext::class,
    ]);
};
