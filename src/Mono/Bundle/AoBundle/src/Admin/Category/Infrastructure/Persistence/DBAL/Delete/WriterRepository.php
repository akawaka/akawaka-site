<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Infrastructure\Persistence\DBAL\Delete;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Delete\Repository\WriterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function delete(CategoryId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->delete('ao_category', 'category')
                ->where('category.id = :id')
                ->setParameters([
                    'id' => $id->getValue(),
                ])
                ->execute()
            ;

            $this->getConnection()->commit();
        } catch (Exception $exception) {
            $this->getConnection()->rollback();

            throw $exception;
        }

        return true;
    }
}
