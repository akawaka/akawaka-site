<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Infrastructure\Persistence\DBAL\Publish;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Publish\WriterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Enum\ArticleStatus;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

class WriterRepository extends DBALRepository implements WriterInterface
{
    public function publish(ArticleId $id): bool
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
                    'status' => ArticleStatus::PUBLISHED,
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
