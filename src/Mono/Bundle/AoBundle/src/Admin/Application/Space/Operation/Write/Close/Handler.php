<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Operation\Write\Close;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Close\CloserInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Close\Exception\SpaceWasNotClosed;
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

    public function __invoke(Command $command): void
    {
        try {
            $this->closer->close($command->getId());
        } catch (SpaceWasNotClosed $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasClosed($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
