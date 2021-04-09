<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Read\FindArticleById;

use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Exception\ArticleNotFoundException;
use Mono\Component\Article\Domain\Repository\FindArticleById;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindArticleById $repository
    ) {
    }

    public function __invoke(Query $query): ArticleInterface
    {
        try {
            $result = $this->repository->find($query->getId());
        } catch (NoResultException $exception) {
            throw new ArticleNotFoundException($query->getId()->getValue());
        }

        return $result;
    }
}
