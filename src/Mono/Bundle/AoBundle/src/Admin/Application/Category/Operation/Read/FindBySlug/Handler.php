<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Category\Operation\Read\FindBySlug;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): CategoryInterface
    {
        return $this->viewer->readBySlug($query->getSlug());
    }
}
