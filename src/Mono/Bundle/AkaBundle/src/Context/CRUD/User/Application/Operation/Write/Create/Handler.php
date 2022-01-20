<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Operation\Write\Create;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\CreatorInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\Exception\UnableToCreateException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private CreatorInterface $creator,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): void
    {
        $user = $this->builder::build([
            'id' => $command->getId(),
            'username' => $command->getUsername(),
            'email' => $command->getEmail(),
            'password' => $command->getPassword(),
        ]);

        try {
            $this->creator->create($user);
        } catch (UnableToCreateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new AdminWasCreated($user->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
