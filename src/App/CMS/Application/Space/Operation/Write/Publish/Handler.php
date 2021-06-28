<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Publish;

use App\CMS\Domain\Space\Operation\Publish\Exception\SpaceWasNotPublished;
use App\CMS\Domain\Space\Operation\Publish\PublisherInterface;
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

    public function __invoke(Command $command): bool
    {
        try {
            $this->publisher->publish($command->getId());
        } catch (SpaceWasNotPublished $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasPublished($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
