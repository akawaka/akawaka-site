<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Application\Operation\Read\FindByCode;

use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): ?SpaceInterface
    {
        return $this->viewer->readByCode($query->getCode());
    }
}
