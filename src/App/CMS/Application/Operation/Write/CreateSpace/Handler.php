<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateSpace;

use App\CMS\Domain\Entity\Space;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Repository\CreateSpace;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CreateSpace $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): SpaceInterface
    {
        $space = Space::create(
            $this->repository->nextIdentity(),
            $command->getCode(),
            $command->getName(),
            $command->getTheme(),
        );

        $this->repository->insert($space);
        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasCreated($space->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $space;
    }
}
