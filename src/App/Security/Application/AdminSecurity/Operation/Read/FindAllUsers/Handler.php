<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Read\FindAllUsers;

use Mono\Component\AdminSecurity\Domain\Repository\FindAllUsers;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindAllUsers $reader
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->reader->findAll();
    }
}
