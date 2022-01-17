<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\MessageBus;

use Symfony\Component\Messenger\Envelope;

interface CommandBusInterface
{
    /**
     * @param Envelope|object $command
     *
     * @return mixed
     */
    public function __invoke($command);
}
