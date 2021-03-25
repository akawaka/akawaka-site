<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectManager;

abstract class DoctrineRepository
{
    protected ?ObjectManager $manager;

    protected string $class;

    public function __construct(ManagerRegistry $registry, string $class)
    {
        $this->manager = $registry->getManagerForClass($class);
        $this->class = $class;
    }

    public function getClassName(): string
    {
        return $this->class;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->manager->createQueryBuilder();
    }

    public function getQuery($sql): Query
    {
        return $this->manager->createQuery($sql);
    }

    public function getNativeQuery($sql, ResultSetMapping $rsm): NativeQuery
    {
        return $this->manager->createNativeQuery($sql, $rsm);
    }

    public function getRsm(): Query\ResultSetMappingBuilder
    {
        return new Query\ResultSetMappingBuilder($this->manager);
    }
}
