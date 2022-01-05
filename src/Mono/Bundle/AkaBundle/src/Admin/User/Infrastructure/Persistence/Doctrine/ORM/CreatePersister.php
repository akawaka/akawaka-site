<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Infrastructure\Persistence\Doctrine\ORM;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\AdminUser;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class CreatePersister implements CreatePersisterInterface
{
    public function __construct(
        private UserPasswordEncoderInterface $passwordEncoder,
        private AdminUserRepository $repository,
    ) {
    }

    public function create(UserInterface $user): bool
    {
        $dbUser = AdminUser::create($user->getId(), $user->getUsername(), $user->getEmailAddress());
        $password = $this->passwordEncoder->encodePassword($dbUser, $user->getPassword());
        $dbUser->updatePassword($password);

        $this->repository->add($dbUser);

        return true;
    }
}
