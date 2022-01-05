<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Publish\DataPersister\PublishPersisterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Enum\SpaceStatus;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class PublishPersisterRepository extends DBALRepository implements PublishPersisterInterface
{
    public function publish(SpaceId $id): bool
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
                    'status' => SpaceStatus::PUBLISHED,
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
