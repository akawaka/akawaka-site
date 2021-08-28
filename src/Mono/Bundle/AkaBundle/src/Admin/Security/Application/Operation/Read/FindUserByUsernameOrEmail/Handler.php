<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\Security\Application\Operation\Read\FindUserByUsernameOrEmail;

use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Shared\Domain\Exception\UserNotFoundException;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository\FindUserByUsernameOrEmail;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindUserByUsernameOrEmail $reader
    ) {
    }

    public function __invoke(Query $query): UserInterface
    {
        try {
            $page = $this->reader->find($query->getUsernameOrEmail());
        } catch (NoResultException $exception) {
            throw new UserNotFoundException($query->getUsernameOrEmail());
        }

        return $page;
    }
}
