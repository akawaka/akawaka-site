<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Operation\Read\FindByCode;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): SpaceInterface
    {
        return $this->viewer->readByCode($query->getCode());
    }
}
