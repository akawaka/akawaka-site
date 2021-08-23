<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Article\Write\Update;

use Mono\Component\Article\Domain\Operation\Article\Update\Factory\BuilderInterface;
use Mono\Component\Article\Domain\Operation\Article\Update\UpdaterInterface;
use Mono\Component\Article\Domain\Operation\Article\Update\Exception\UnableToUpdateException;
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
        $article = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'content' => $command->getContent(),
            'categories' => $command->getCategories(),
            'authors' => $command->getAuthors(),
        ]);

        try {
            $this->updater->update($article);
        } catch (UnableToUpdateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
