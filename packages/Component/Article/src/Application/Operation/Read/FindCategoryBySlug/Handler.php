<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Read\FindCategoryBySlug;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Exception\CategoryNotFoundException;
use Mono\Component\Article\Domain\Repository\FindCategoryBySlug;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindCategoryBySlug $repository
    ) {
    }

    public function __invoke(Query $query): CategoryInterface
    {
        try {
            $result = $this->repository->find($query->getSlug());
        } catch (NoResultException $exception) {
            throw new CategoryNotFoundException($query->getSlug()->getValue());
        }

        return $result;
    }
}
