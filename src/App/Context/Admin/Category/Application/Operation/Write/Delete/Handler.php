<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Operation\Write\Delete;

use App\Context\Admin\Category\Domain\Delete\DeleterInterface;
use App\Context\Admin\Category\Domain\Delete\Exception\UnableToDeleteException;
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
            (new Envelope(new CategoryWasDeleted($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
