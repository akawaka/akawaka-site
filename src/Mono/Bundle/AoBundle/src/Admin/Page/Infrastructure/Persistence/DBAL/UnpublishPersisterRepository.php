<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Unpublish\DataPersister\UnpublishPersisterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Enum\PageStatus;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class UnpublishPersisterRepository extends DBALRepository implements UnpublishPersisterInterface
{
    public function close(PageId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_page')
                ->set('status', ':status')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'status' => PageStatus::DRAFT,
                    'update' => (new \Safe\DateTimeImmutable())->format('Y-m-d H:i:s'),
                    'id' => $id->getValue(),
                ])
                ->execute()
            ;

            $this->getConnection()->commit();
        } catch (Exception $exception) {
            $this->getConnection()->rollback();

            return false;
        }

        return true;
    }
}
