<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Read\FindCategoryBySlug;

use Doctrine\ORM\NoResultException;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Exception\CategoryNotFoundException;
use Mono\Component\Article\Domain\Repository\FindCategoryBySlug;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindCategoryBySlug $reader
    ) {
    }

    public function __invoke(Query $query): CategoryInterface
    {
        try {
            $result = $this->reader->find($query->getSlug());
        } catch (NoResultException $exception) {
            throw new CategoryNotFoundException($query->getSlug()->getValue());
        }

        return $result;
    }
}
