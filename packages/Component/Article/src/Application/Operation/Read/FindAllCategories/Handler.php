<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Read\FindAllCategories;

use Mono\Component\Article\Domain\Repository\FindAllCategories;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindAllCategories $repository
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->repository->findAll();
    }
}
