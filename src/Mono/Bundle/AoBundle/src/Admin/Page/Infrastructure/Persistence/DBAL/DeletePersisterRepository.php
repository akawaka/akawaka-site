<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Delete\DataPersister\DeletePersisterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class DeletePersisterRepository extends DBALRepository implements DeletePersisterInterface
{
    public function delete(PageId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->delete('ao_page', 'page')
                ->where('page.id = :id')
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
