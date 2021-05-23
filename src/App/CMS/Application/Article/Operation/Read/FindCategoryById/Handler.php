<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Read\FindCategoryById;

use Doctrine\ORM\NoResultException;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Exception\CategoryNotFoundException;
use Mono\Component\Article\Domain\Repository\FindCategoryById;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindCategoryById $reader
    ) {
    }

    public function __invoke(Query $query): CategoryInterface
    {
        try {
            $results = $this->reader->find($query->getId());
        } catch (NoResultException $exception) {
            throw new CategoryNotFoundException($query->getId()->getValue());
        }

        return $results;
    }
}
