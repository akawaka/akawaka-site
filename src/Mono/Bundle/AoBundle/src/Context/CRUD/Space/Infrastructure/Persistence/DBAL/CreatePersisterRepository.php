<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Create\DataPersister\Model\SpaceInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class CreatePersisterRepository extends DBALRepository implements CreatePersisterInterface
{
    public function create(SpaceInterface $space): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->insert('ao_space')
                ->values([
                    'id' => ':id',
                    'code' => ':code',
                    'name' => ':name',
                    'status' => ':status',
                    'creation_date' => ':creation_date',
                ])
                ->setParameters([
                    'id' => $space->getId()->getValue(),
                    'code' => $space->getCode()->getValue(),
                    'name' => $space->getName(),
                    'status' => $space->getStatus(),
                    'creation_date' => $space->getCreationDate()->format('Y-m-d H:i:s'),
                ])
                ->executeQuery()
            ;

            $this->getConnection()->commit();
        } catch (Exception $exception) {
            $this->getConnection()->rollback();

            throw $exception;
        }

        return true;
    }
}
