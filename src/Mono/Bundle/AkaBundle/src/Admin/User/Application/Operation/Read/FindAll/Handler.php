<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Read\FindAll;

use Mono\Bundle\AkaBundle\Admin\User\Domain\View\DataProvider\Model\UserListInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): UserListInterface
    {
        return $this->viewer->readAll();
    }
}
