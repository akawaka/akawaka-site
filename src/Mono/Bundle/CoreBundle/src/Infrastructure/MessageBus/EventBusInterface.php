<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\MessageBus;

use Symfony\Component\Messenger\Envelope;

interface EventBusInterface
{
    /**
     * @param Envelope|object $event
     *
     * @return mixed
     */
    public function __invoke($event);
}
