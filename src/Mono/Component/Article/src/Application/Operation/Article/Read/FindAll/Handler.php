<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Article\Read\FindAll;

use Mono\Component\Article\Domain\Operation\Article\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->viewer->readAll();
    }
}