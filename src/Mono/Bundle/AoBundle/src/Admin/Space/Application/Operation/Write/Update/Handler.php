<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Write\Update;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\Exception\SpaceWasNotUpdated;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\UpdaterInterface;
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
                $command->getTheme(),
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
