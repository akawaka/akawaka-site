<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Update;

use Mono\Component\Space\Domain\Operation\Update\Exception\UnableToUpdateException;
use Mono\Component\Space\Domain\Operation\Update\UpdaterInterface;
use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;
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

    public function __invoke(Command $command): bool
    {
        try {
            $this->updater->update(
                $command->getId(),
                $command->getName(),
                $command->getUrl(),
                $command->getDescription(),
            );
        } catch (UnableToUpdateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
