<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Space\Domain\Close\DataPersister\ClosePersisterInterface;
use App\Shared\Domain\Enum\SpaceStatus;
use App\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class ClosePersisterRepository extends DBALRepository implements ClosePersisterInterface
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
