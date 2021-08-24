<?php

declare(strict_types=1);

namespace Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

abstract class DBALRepository
{
    public function __construct(
        private Connection $connection,
    ) {
    }

    public function getConnection(): Connection
    {
        return $this->connection;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->connection->createQueryBuilder();
    }

    public function beginTransaction(): bool
    {
        return $this->connection->beginTransaction();
    }
}
