<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\MessageBus;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class AsyncEventBus implements EventBusInterface
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $eventBus,
    ) {
        $this->messageBus = $eventBus;
    }

    public function __invoke($query)
    {
        $this->messageBus->dispatch($query);
    }
}
