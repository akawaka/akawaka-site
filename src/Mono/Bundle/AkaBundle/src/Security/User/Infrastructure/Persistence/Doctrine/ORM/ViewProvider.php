<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Mono\Bundle\AkaBundle\Security\User\Domain\View\DataProvider\Factory\BuilderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Mono\Bundle\AkaBundle\Security\User\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AkaBundle\Security\User\Domain\View\Exception\UnknownUserException;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;

final class ViewProvider implements ViewProviderInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private AdminUserRepository $repository,
    ) {
    }

    public function view(string $usernameOrEmail): UserInterface
    {
        try {
            $result = $this->repository->findByUsernameOrEmail($usernameOrEmail);
        } catch (NoResultException $e) {
            throw new UnknownUserException($usernameOrEmail);
        } catch (NonUniqueResultException $e) {
            throw new UnknownUserException($usernameOrEmail);
        }

        return $result;
    }
}
