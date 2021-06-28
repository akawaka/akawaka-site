<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Space\Close;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use App\CMS\Domain\Space\Operation\Close\Repository\WriterInterface;
use App\CMS\Domain\Space\Common\Enum\StatusEnum;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function close(SpaceId $id): bool
    {
        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('cms_space')
                ->set('status', ':status')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'status' => StatusEnum::CLOSED,
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
