<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Read\FindAll;

use Mono\Component\AdminSecurity\Domain\Repository\FindAll;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindAll $repository
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->repository->findAll();
    }
}
