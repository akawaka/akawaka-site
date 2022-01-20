<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Application\Operation\Write\GeneratePassword;

use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\Exception\UnableToUpdateException;
use Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\GeneratePassword\UpdaterInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private UpdaterInterface $updater,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): void
    {
        $password = $this->builder::build([
            'token' => $command->getToken(),
            'password' => $command->getPassword(),
        ]);

        try {
            $this->updater->update($password);
        } catch (UnableToUpdateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new PasswordWasGenerated($command->getToken())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
