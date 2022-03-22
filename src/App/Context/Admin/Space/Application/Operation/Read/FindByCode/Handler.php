<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Operation\Read\FindByCode;

use App\Context\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use App\Context\Admin\Space\Domain\View\ViewerInterface;
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
