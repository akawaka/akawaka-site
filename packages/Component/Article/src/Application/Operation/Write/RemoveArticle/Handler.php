<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\RemoveArticle;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository\RemoveArticle;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private RemoveArticle $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ArticleInterface
    {
        $entity = $command->getArticle();

        $this->repository->remove($entity);
        $this->eventBus->dispatch(new ArticleWasRemoved($entity));

        return $entity;
    }
}
