<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Remove;

use App\CMS\Domain\Space\Operation\Delete\DeleterInterface;
use App\CMS\Domain\Space\Operation\Delete\Exception\SpaceWasNotDeleted;
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

    public function __invoke(Command $command): bool
    {
        try {
            $this->deleter->delete($command->getId());
        } catch (SpaceWasNotDeleted $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasRemoved($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
