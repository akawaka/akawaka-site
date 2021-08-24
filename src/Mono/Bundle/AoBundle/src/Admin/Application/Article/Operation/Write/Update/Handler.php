<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Write\Update;

use Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Write\Update\ArticleWasUpdated;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\UpdaterInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Exception\UnableToUpdateException;
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
