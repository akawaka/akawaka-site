<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UnpublishArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository\UpdateArticle;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private UpdateArticle $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ArticleInterface
    {
        $entity = $command->getArticle();
        $entity->unpublish();

        $this->repository->update($entity);
        $this->eventBus->dispatch(new ArticleWasUnpublished($entity));

        return $entity;
    }
}
