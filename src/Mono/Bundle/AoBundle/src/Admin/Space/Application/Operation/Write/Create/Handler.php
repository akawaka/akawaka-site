<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Write\Create;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\CreatorInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Factory\BuilderInterface;
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

    public function __invoke(Command $command): void
    {
        $space = $this->builder::build([
            'id' => $command->getId(),
            'code' => $command->getCode(),
            'name' => $command->getName(),
            'theme' => $command->getTheme(),
        ]);

        try {
            $this->creator->create($space);
        } catch (UnableToCreateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new SpaceWasCreated($space->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
