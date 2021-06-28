<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Write\Create;

use Mono\Component\Space\Domain\Operation\Create\CreatorInterface;
use Mono\Component\Space\Domain\Operation\Create\Model\Space;
use Mono\Component\Space\Domain\Operation\Create\Model\SpaceInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CreatorInterface $creator,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): SpaceInterface
    {
        $space = new Space(
            $this->creator->nextIdentity(),
            $command->getCode(),
            $command->getName(),
        );

        $this->creator->create($space);

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasCreated($space->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $space;
    }
}
