<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\Delete;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Delete\DeleterInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Delete\Exception\UnableToDeleteException;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private DeleterInterface $deleter,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): void
    {
        try {
            $this->deleter->delete($command->getId());
        } catch (UnableToDeleteException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new AdminWasDeleted($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
