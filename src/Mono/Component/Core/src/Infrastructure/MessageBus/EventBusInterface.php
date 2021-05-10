<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\MessageBus;

interface EventBusInterface
{
    public function __invoke($query);
}
