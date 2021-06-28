<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Read\FindById;

use Mono\Component\Space\Domain\Operation\View\Model\SpaceInterface;
use Mono\Component\Space\Domain\Operation\View\ViewerInterface;
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
