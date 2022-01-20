<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Delete\DataPersister\DeletePersisterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class DeletePersisterRepository extends DBALRepository implements DeletePersisterInterface
{
    public function delete(AuthorId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->delete('ao_author', 'author')
                ->where('author.id = :id')
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
