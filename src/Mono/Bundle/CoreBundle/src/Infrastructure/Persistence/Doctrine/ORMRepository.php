<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

abstract class ORMRepository
{
    protected ?ObjectManager $manager;

    protected string $class;

    public function __construct(ManagerRegistry $registry, string $class)
    {
        $this->manager = $registry->getManager();
        $this->class = $class;
    }

    public function getClass()
    {
        return new ($this->manager->getClassMetadata($this->getClassName())->getName());
    }

    public function getClassName(): string
    {
        return $this->class;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        // @phpstan-ignore-next-line
        return $this->manager->createQueryBuilder();
    }

    public function getQuery(string $sql): Query
    {
        // @phpstan-ignore-next-line
        return $this->manager->createQuery($sql);
    }

    public function getNativeQuery(string $sql, ResultSetMapping $rsm): NativeQuery
    {
        // @phpstan-ignore-next-line
        return $this->manager->createNativeQuery($sql, $rsm);
    }

    public function getRsm(): Query\ResultSetMappingBuilder
    {
        // @phpstan-ignore-next-line
        return new Query\ResultSetMappingBuilder($this->manager);
    }
}
