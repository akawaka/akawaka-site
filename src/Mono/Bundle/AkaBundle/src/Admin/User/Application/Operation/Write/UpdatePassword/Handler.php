<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\UpdatePassword;

use Mono\Bundle\AkaBundle\Shared\Domain\Repository\FindUserById;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository\UpdateUser;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindUserById $reader,
        private UpdateUser $writer,
        private UserPasswordEncoderInterface $passwordEncoder,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): UserInterface
    {
        $user = $this->reader->find($command->getId());
        $user->updatePassword(
            $this->passwordEncoder->encodePassword($user, $command->getPassword())
        );

        $this->writer->update($user);
        $this->eventBus->dispatch(
            (new Envelope(new AdminPasswordWasUpdated($user->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $user;
    }
}
