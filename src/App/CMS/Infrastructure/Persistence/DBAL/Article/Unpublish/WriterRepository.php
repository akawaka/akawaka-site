<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Article\Unpublish;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use App\CMS\Domain\Article\Operation\Unpublish\WriterInterface;
use App\CMS\Domain\Article\Common\Enum\StatusEnum;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function close(ArticleId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('cms_article')
                ->set('status', ':status')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'status' => StatusEnum::DRAFT,
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
