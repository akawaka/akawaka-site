<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Operation\Write\Remove;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Delete\DeleterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Delete\Exception\SpaceWasNotDeleted;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private DeleterInterface $deleter,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): void
    {
        try {
            $this->deleter->delete($command->getId());
        } catch (SpaceWasNotDeleted $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasRemoved($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
