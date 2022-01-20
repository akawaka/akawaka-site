<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Operation\Write\Update;

use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Update\UpdaterInterface;
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
