<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\MessageBus;

interface CommandBusInterface
{
    public function __invoke($query);
}
