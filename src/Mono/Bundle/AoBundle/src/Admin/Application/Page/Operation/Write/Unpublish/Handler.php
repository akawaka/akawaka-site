<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Write\Unpublish;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Unpublish\CloserInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Unpublish\Exception\CloseFailedException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CloserInterface $closer,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): void
    {
        try {
            $this->closer->close($command->getId());
        } catch (CloseFailedException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new PageWasUnpublished($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
