<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Operation\Read\FindAll;

use Mono\Component\Space\Domain\Repository\FindAllSpaces;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindAllSpaces $reader
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->reader->findAll();
    }
}
