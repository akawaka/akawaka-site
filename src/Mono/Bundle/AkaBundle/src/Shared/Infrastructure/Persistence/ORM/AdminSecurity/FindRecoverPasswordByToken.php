<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\ORM\AdminSecurity;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\AdminPasswordRecovery;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Bundle\AkaBundle\Shared\Domain\Entity\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Repository;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindRecoverPasswordByToken extends ORMRepository implements Repository\FindRecoverPasswordByToken
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, AdminPasswordRecovery::class);
    }

    public function find(string $token): ?PasswordRecoveryInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT password
                FROM {$this->getClassName()} password
                WHERE password.token = :token
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('token', $token),
        ]));

        return $query->getSingleResult();
    }
}
