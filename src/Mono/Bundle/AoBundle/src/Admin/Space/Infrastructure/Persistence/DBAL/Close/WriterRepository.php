<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Infrastructure\Persistence\DBAL\Close;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Close\Repository\WriterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Enum\SpaceStatus;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function close(SpaceId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_space')
                ->set('status', ':status')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'status' => SpaceStatus::CLOSED,
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
