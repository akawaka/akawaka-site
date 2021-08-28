<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Operation\Write\Create;

use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\CreatorInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Factory\BuilderInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private CreatorInterface $creator,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): bool
    {
        $article = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'categories' => $command->getCategories(),
            'authors' => $command->getAuthors(),
            'spaces' => $command->getSpaces(),
        ]);

        try {
            $this->creator->create($article);
        } catch (UnableToCreateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasCreated($article->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
