<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Article\Write\Create;

use Mono\Component\Article\Domain\Operation\Article\Create\CreatorInterface;
use Mono\Component\Article\Domain\Operation\Article\Create\Exception\UnableToCreateException;
use Mono\Component\Article\Domain\Operation\Article\Create\Factory\BuilderInterface;
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

    public function __invoke(Command $command): void
    {
        $article = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'categories' => $command->getCategories(),
            'authors' => $command->getAuthors(),
        ]);

        try {
            $this->creator->create($article);
        } catch (UnableToCreateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasCreated($article->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
