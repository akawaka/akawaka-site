<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): ?SpaceInterface
    {
        return $this->viewer->read($query->getId());
    }
}
