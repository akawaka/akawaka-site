<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Read\FindCategoryById;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Exception\CategoryNotFoundException;
use Mono\Component\Article\Domain\Repository\FindCategoryById;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindCategoryById $repository
    ) {
    }

    public function __invoke(Query $query): CategoryInterface
    {
        try {
            $results = $this->repository->find($query->getId());
        } catch (NoResultException $exception) {
            throw new CategoryNotFoundException($query->getId()->getValue());
        }

        return $results;
    }
}
