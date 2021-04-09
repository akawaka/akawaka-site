<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use App\Security\Domain\Entity\AdminUser;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

final class FindBySlug extends DoctrineRepository implements Repository\FindByUsernameOrEmail
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, AdminUser::class);
    }

    public function find(string $usernameOrEmail): UserInterface
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
}
