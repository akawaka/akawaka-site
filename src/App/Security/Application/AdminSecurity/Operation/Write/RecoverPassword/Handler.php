<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Write\RecoverPassword;

use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Repository\FindRecoverPasswordByToken;
use Mono\Component\AdminSecurity\Domain\Repository\RemoveRecoverPassword;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindRecoverPasswordByToken $reader,
        private RemoveRecoverPassword $writer,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): PasswordRecoveryInterface
    {
        $passwordRecovery = $this->reader->find($command->getToken());

        $this->writer->remove($passwordRecovery);
        $this->eventBus->dispatch(
            (new Envelope(new PasswordRecoveryWasRemoved($passwordRecovery->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $passwordRecovery;
    }
}
