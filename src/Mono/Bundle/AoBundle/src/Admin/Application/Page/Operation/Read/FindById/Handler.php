<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\View\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\View\ViewerInterface;
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
