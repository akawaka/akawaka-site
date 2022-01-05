<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\PasswordRecoveryId;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\PasswordRecoveryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\ORMRepository;

final class PasswordRecoveryRepository extends ORMRepository
{
    public function __construct(
        ManagerRegistry $managerRegistry,
    ) {
        parent::__construct($managerRegistry, PasswordRecoveryInterface::class);
    }

    public function findByToken(string $token): PasswordRecoveryInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT recovery
                FROM {$this->class} recovery
                WHERE recovery.token = :token
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('token', $token),
        ]));

        return $query->getSingleResult();
    }

    public function find(PasswordRecoveryId $id): ?PasswordRecoveryInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT password
                FROM {$this->getClassName()} password
                WHERE password.id = :id
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('id', $id->getValue()),
        ]));

        return $query->getSingleResult();
    }

    public function persist(PasswordRecoveryInterface $passwordRecovery)
    {
        $this->manager->persist($passwordRecovery);
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
