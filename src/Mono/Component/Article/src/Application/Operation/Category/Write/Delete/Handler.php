<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Category\Write\Delete;

use Mono\Component\Article\Domain\Operation\Category\Delete\DeleterInterface;
use Mono\Component\Article\Domain\Operation\Category\Delete\Exception\UnableToDeleteException;
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

    public function __invoke(Command $command): bool
    {
        try {
            $this->deleter->delete($command->getId());
        } catch (UnableToDeleteException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new CategoryWasDeleted($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
