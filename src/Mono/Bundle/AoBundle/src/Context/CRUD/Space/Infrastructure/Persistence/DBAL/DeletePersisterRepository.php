<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Space\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\Delete\DataPersister\DeletePersisterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class DeletePersisterRepository extends DBALRepository implements DeletePersisterInterface
{
    public function delete(SpaceId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->delete('ao_space', 'space')
                ->where('space.id = :id')
                ->setParameters([
                    'id' => $id->getValue(),
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
