<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Read\FindAll;

use Mono\Component\Page\Domain\Repository\FindAllPages;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindAllPages $reader
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->reader->findAll();
    }
}
