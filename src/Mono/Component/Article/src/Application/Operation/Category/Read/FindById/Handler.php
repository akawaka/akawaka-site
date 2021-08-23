<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Category\Read\FindById;

use Mono\Component\Article\Domain\Operation\Category\View\Model\CategoryInterface;
use Mono\Component\Article\Domain\Operation\Category\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): CategoryInterface
    {
        return $this->viewer->read($query->getId());
    }
}
