<?php

declare(strict_types=1);

namespace Mono\Component\Article\Infrastructure\Persistence\DBAL\Category\Delete;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Article\Domain\Operation\Category\Delete\Repository\WriterInterface;
use Mono\Component\Article\Domain\Common\Identifier\CategoryId;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function delete(CategoryId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->delete('cms_category', 'category')
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
