<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class UpdatePersisterRepository extends DBALRepository implements UpdatePersisterInterface
{
    public function update(SpaceInterface $space): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_space')
                ->set('name', ':name')
                ->set('url', ':url')
                ->set('description', ':description')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'name' => $space->getName(),
                    'url' => $space->getUrl(),
                    'description' => $space->getDescription(),
                    'update' => (new \Safe\DateTimeImmutable())->format('Y-m-d H:i:s'),
                    'id' => $space->getId()->getValue(),
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
