<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Application\Operation\Read\FindByUsernameOrEmail;

use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Security\User\Domain\View\ViewInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Exception\UserNotFoundException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewInterface $viewer
    ) {
    }

    public function __invoke(Query $query): UserInterface
    {
        try {
            $user = ($this->viewer)($query->getUsernameOrEmail());
        } catch (NoResultException $exception) {
            throw new UserNotFoundException($query->getUsernameOrEmail());
        }

        return $user;
    }
}
