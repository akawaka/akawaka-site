<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateArticle;

use App\CMS\Domain\Entity\Article;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository\CreateArticle;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CreateArticle $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ArticleInterface
    {
        $entity = Article::create(
            $this->repository->nextIdentity(),
            $command->getSlug(),
            $command->getName(),
            $command->getCategories(),
            $command->getChannels(),
        );

        $this->repository->insert($entity);
        $this->eventBus->dispatch(new ArticleWasCreated($entity));

        return $entity;
    }
}
