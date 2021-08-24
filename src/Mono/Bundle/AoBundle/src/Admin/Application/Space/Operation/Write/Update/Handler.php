<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Operation\Write\Update;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Update\Exception\SpaceWasNotUpdated;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\Update\UpdaterInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private UpdaterInterface $updater,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): void
    {
        try {
            $this->updater->update(
                $command->getId(),
                $command->getName(),
                $command->getUrl(),
                $command->getDescription(),
            );
        } catch (SpaceWasNotUpdated $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
