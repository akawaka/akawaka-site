<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Black\Component\Core\Infrastructure\Notifier\Channel\BrowserChannel;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services();

    $services
        ->set('notifier.channel.browser', BrowserChannel::class)
        ->args([
            service('request_stack'),
            "state",
        ])
        ->tag('notifier.channel', [
            'channel' => "browser",
        ]);
};
