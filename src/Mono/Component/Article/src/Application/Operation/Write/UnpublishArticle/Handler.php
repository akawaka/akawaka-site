<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UnpublishArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository\FindArticleById;
use Mono\Component\Article\Domain\Repository\UpdateArticle;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindArticleById $reader,
        private UpdateArticle $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ArticleInterface
    {
        $article = $this->reader->find($command->getArticleId());
        $article->unpublish();

        $this->writer->update($article);
        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasUnpublished($article->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $article;
    }
}
