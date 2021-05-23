<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Write\RemoveArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository\FindArticleById;
use Mono\Component\Article\Domain\Repository\RemoveArticle;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindArticleById $reader,
        private RemoveArticle $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ArticleInterface
    {
        $article = $this->reader->find($command->getArticleId());

        $this->writer->remove($article);
        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasRemoved($article->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $article;
    }
}
