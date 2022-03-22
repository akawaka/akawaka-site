<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Operation\Write\Update;

use App\Context\Admin\Category\Domain\Update\DataPersister\Factory\BuilderInterface;
use App\Context\Admin\Category\Domain\Update\Exception\UnableToUpdateException;
use App\Context\Admin\Category\Domain\Update\UpdaterInterface;
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
