<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Category\Write\Update;

use Mono\Component\Article\Domain\Operation\Category\Update\Factory\BuilderInterface;
use Mono\Component\Article\Domain\Operation\Category\Update\UpdaterInterface;
use Mono\Component\Article\Domain\Operation\Category\Update\Exception\UnableToUpdateException;
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
        $category = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
        ]);

        try {
            $this->updater->update($category);
        } catch (UnableToUpdateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new CategoryWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
