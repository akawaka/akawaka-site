<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Write\Publish;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\Exception\SpaceWasNotPublished;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\PublisherInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private PublisherInterface $publisher,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): void
    {
        try {
            $this->publisher->publish($command->getId());
        } catch (SpaceWasNotPublished $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasPublished($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
