<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\UpdatePassword;

use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\Exception\UnableToUpdateException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\UpdaterInterface;
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

    public function __invoke(Command $command): bool
    {
        $user = $this->builder::build([
            'id' => $command->getId(),
            'password' => $command->getPassword(),
        ]);

        try {
            $this->updater->update($user);
        } catch (UnableToUpdateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new AdminPasswordWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
