<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Operation\Write\Create;

use Mono\Bundle\AoBundle\Domain\Space\Operation\Create\CreatorInterface;
use Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Domain\Space\Operation\Create\Factory\BuilderInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private CreatorInterface $creator,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): SpaceInterface
    {
        $space = $this->builder::build([
            'id' => $command->getId(),
            'code' => $command->getCode(),
            'name' => $command->getName(),
            'theme' => $command->getTheme(),
        ]);

        $this->creator->create($space);

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasCreated($space->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $space;
    }
}
