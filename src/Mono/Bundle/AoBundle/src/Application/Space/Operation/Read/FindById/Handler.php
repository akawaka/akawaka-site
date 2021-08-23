<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): SpaceInterface
    {
        return $this->viewer->read($query->getId());
    }
}
