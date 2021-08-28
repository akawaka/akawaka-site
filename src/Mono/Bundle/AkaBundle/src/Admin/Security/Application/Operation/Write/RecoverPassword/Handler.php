<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Write\RecoverPassword;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository\FindRecoverPasswordByToken;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository\RemoveRecoverPassword;
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
