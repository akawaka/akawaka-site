<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Read\FindAll;

use Mono\Bundle\AkaBundle\Shared\Domain\Repository\FindAllUsers;
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
