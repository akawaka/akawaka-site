<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Operation\Write\Update;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\UpdaterInterface;
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
        $article = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'content' => $command->getContent(),
            'categories' => $command->getCategories(),
            'authors' => $command->getAuthors(),
            'spaces' => $command->getSpaces(),
        ]);

        try {
            $this->updater->update($article);
        } catch (UnableToUpdateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
