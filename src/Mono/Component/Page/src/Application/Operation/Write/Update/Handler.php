<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Write\Update;

use Mono\Component\Page\Domain\Operation\Update\Factory\BuilderInterface;
use Mono\Component\Page\Domain\Operation\Update\UpdaterInterface;
use Mono\Component\Page\Domain\Operation\Update\Exception\UnableToUpdateException;
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
        $page = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'content' => $command->getContent(),
        ]);

        try {
            $this->updater->update($page);
        } catch (UnableToUpdateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new PageWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
