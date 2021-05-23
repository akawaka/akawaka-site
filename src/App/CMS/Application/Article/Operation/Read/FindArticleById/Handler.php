<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Read\FindArticleById;

use Doctrine\ORM\NoResultException;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Exception\ArticleNotFoundException;
use Mono\Component\Article\Domain\Repository\FindArticleById;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindArticleById $reader
    ) {
    }

    public function __invoke(Query $query): ArticleInterface
    {
        try {
            $result = $this->reader->find($query->getId());
        } catch (NoResultException $exception) {
            throw new ArticleNotFoundException($query->getId()->getValue());
        }

        return $result;
    }
}
