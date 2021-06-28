<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Space\Update;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use App\CMS\Domain\Space\Operation\Update\Repository\WriterInterface;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description
    ): bool {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('cms_space')
                ->set('name', ':name')
                ->set('url', ':url')
                ->set('description', ':description')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'name' => $name,
                    'url' => $url,
                    'description' => $description,
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
