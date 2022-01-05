<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Application\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Admin\Category\Domain\View\DataProvider\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Admin\Category\Domain\View\ViewerInterface;
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
