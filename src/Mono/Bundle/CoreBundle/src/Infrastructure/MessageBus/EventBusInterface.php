<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\MessageBus;

interface EventBusInterface
{
    public function __invoke($query);
}
