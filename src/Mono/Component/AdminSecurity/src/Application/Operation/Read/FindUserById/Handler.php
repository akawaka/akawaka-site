<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Read\FindUserById;

use Doctrine\ORM\NoResultException;
use Mono\Component\AdminSecurity\Domain\Exception\UserNotFoundException;
use Mono\Component\AdminSecurity\Domain\Repository\FindUserById;
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
