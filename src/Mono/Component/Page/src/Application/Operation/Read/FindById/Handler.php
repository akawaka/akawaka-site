<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Read\FindById;

use Mono\Component\Page\Domain\Operation\View\Model\PageInterface;
use Mono\Component\Page\Domain\Operation\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): PageInterface
    {
        return $this->viewer->read($query->getId());
    }
}
