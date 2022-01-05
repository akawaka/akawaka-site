<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Read\FindById;

use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Admin\User\Domain\View\DataProvider\Model\UserInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\View\ViewerInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Exception\UserNotFoundException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): UserInterface
    {
        try {
            $page = $this->viewer->read($query->getId());
        } catch (NoResultException $exception) {
            throw new UserNotFoundException($query->getId()->getValue());
        }

        return $page;
    }
}
