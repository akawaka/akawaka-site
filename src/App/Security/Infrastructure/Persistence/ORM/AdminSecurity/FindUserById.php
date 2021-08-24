<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Persistence\ORM\AdminSecurity;

use App\Security\Domain\Entity\AdminUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Mono\Component\AdminSecurity\Domain\Repository;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindUserById extends ORMRepository implements Repository\FindUserById
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
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
}
