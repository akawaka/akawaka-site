<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\MessageBus;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class SyncCommandBus implements CommandBusInterface
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $commandBus,
    ) {
        $this->messageBus = $commandBus;
    }

    public function __invoke($query)
    {
        return $this->handle($query);
    }
}
