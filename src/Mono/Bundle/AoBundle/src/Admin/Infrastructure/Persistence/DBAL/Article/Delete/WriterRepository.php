<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Infrastructure\Persistence\DBAL\Article\Delete;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Delete\Repository\WriterInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function delete(ArticleId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->delete('ao_article', 'article')
                ->where('article.id = :id')
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
