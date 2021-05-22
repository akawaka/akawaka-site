<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\UpdateSpace;

use Mono\Component\Space\Application\Operation\Write\Update\SpaceWasUpdated;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Repository\FindSpaceById;
use Mono\Component\Space\Domain\Repository\UpdateSpace;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindSpaceById $reader,
        private UpdateSpace $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): SpaceInterface
    {
        $space = $this->reader->find($command->getId());
        $space->updateTheme($command->getTheme());
        $space->update(
            $command->getName(),
            $command->getUrl(),
            $command->getDescription(),
        );

        $this->writer->update($space);
        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasUpdated($space->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $space;
    }
}
