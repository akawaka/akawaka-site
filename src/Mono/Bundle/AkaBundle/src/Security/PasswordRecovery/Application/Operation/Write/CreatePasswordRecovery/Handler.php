<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Operation\Write\CreatePasswordRecovery;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\Exception\UnableToCreateRecoveryPasswordException;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\Create\CreatorInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private CreatorInterface $updater,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): void
    {
        $recovery = $this->builder::build([
            'id' => $command->getId(),
            'usernameOrEmail' => $command->getUsernameOrEmail(),
        ]);

        try {
            $this->updater->create($recovery);
        } catch (UnableToCreateRecoveryPasswordException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new PasswordRecoveryWasCreated($recovery->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
