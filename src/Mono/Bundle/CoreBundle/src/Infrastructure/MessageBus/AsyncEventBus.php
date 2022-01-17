<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\MessageBus;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class AsyncEventBus implements EventBusInterface
{
    use HandleTrait;

    public function __construct(
        // @phpstan-ignore-next-line
        private MessageBusInterface $eventBus,
    ) {
        $this->messageBus = $eventBus;
    }

    /**
     * @param Envelope|object $event
     *
     * @return mixed
     */
    public function __invoke($event)
    {
        $this->messageBus->dispatch($event);
    }
}
