<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\AdminUser;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

final class AdminUserRepository extends ORMRepository
{
    public function __construct(
        ManagerRegistry $managerRegistry,
    ) {
        parent::__construct($managerRegistry, AdminUser::class);
    }

    public function find(UserId $id): UserInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT user
                FROM {$this->getClassName()} user
                WHERE user.id = :id
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('id', $id->getValue()),
        ]));

        return $query->getSingleResult();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function findByUsername(Username $username): UserInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT user
                FROM {$this->getClassName()} user
                WHERE user.username = :username
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('username', $username->getValue()),
        ]));

        return $query->getSingleResult();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function findByUsernameOrEmail(string $usernameOrEmail): UserInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT user
                FROM {$this->getClassName()} user
                WHERE user.username = :usernameOrEmail OR user.email = :usernameOrEmail
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('usernameOrEmail', $usernameOrEmail),
        ]));

        return $query->getSingleResult();
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
                SELECT user
                FROM {$this->getClassName()} user
            SQL);

        return $query->execute();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(UserInterface $user): void
    {
        $this->manager->persist($user);
        $this->manager->flush();
    }

    public function delete(UserInterface $user): void
    {
        $this->manager->remove($user);
        $this->manager->flush();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function flush(): void
    {
        $this->manager->flush();
    }
}
