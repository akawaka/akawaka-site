<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Close;

use App\CMS\Domain\Space\Operation\Close\CloserInterface;
use App\CMS\Domain\Space\Operation\Close\Exception\SpaceWasNotClosed;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CloserInterface $closer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): bool
    {
        try {
            $this->closer->close($command->getId());
        } catch (SpaceWasNotClosed $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasClosed($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
