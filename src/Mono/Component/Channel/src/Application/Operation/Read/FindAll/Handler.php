<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Read\FindAll;

use Mono\Component\Channel\Domain\Repository\FindAllChannels;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindAllChannels $reader
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->reader->findAll();
    }
}
