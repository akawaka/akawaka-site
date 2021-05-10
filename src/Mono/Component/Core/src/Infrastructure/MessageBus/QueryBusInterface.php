<?php

declare(strict_types=1);

namespace Mono\Component\Core\Infrastructure\MessageBus;

interface QueryBusInterface
{
    public function __invoke($query);
}
