<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Read\GetByUsernameOrEmail;

use Mono\Component\AdminSecurity\Domain\Exception\UserNotFoundException;
use Mono\Component\AdminSecurity\Domain\Repository\FindByUsernameOrEmail;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindByUsernameOrEmail $repository
    ) {
    }

    public function __invoke(Query $query): UserInterface
    {
        try {
            $page = $this->repository->find($query->getUsernameOrEmail());
        } catch (NoResultException $exception) {
            throw new UserNotFoundException($query->getUsernameOrEmail());
        }

        return $page;
    }
}
