<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Application\Operation\Write\AuthenticateUser;

use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\ConnectInterface;
use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\Exception\UnableToConnectException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private ConnectInterface $operation,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): bool
    {
        $user = $this->builder::build([
            'username' => $command->getUsername(),
        ]);

        try {
            ($this->operation)($user);
        } catch (UnableToConnectException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new UserWasAuthenticated($user->getUsername()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
