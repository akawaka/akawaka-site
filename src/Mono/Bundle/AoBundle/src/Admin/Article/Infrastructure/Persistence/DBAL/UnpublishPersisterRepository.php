<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Unpublish\DataPersister\UnpublishPersisterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Enum\ArticleStatus;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class UnpublishPersisterRepository extends DBALRepository implements UnpublishPersisterInterface
{
    public function close(ArticleId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_article')
                ->set('status', ':status')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'status' => ArticleStatus::DRAFT,
                    'update' => (new \Safe\DateTimeImmutable())->format('Y-m-d H:i:s'),
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
