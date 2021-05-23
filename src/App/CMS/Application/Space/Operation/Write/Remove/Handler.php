<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Remove;

use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Repository\FindSpaceById;
use Mono\Component\Space\Domain\Repository\RemoveSpace;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindSpaceById $reader,
        private RemoveSpace $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): SpaceInterface
    {
        $space = $this->reader->find($command->getId());

        $this->writer->remove($space);
        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasRemoved($space->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $space;
    }
}
