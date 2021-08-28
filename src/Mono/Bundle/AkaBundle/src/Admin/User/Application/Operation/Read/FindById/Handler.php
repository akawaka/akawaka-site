<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Read\FindById;

use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Shared\Domain\Exception\UserNotFoundException;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository\FindUserById;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindUserById $reader
    ) {
    }

    public function __invoke(Query $query): UserInterface
    {
        try {
            $page = $this->reader->find($query->getId());
        } catch (NoResultException $exception) {
            throw new UserNotFoundException($query->getId()->getValue());
        }

        return $page;
    }
}
