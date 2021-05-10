<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Read\FindArticleBySlug;

use Doctrine\ORM\NoResultException;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Exception\ArticleNotFoundException;
use Mono\Component\Article\Domain\Repository\FindArticleBySlug;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindArticleBySlug $reader
    ) {
    }

    public function __invoke(Query $query): ArticleInterface
    {
        try {
            $result = $this->reader->find($query->getSlug());
        } catch (NoResultException $exception) {
            throw new ArticleNotFoundException($query->getSlug()->getValue());
        }

        return $result;
    }
}
