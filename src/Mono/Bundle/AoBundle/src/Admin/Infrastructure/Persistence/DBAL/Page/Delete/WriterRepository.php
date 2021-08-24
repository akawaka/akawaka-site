<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Infrastructure\Persistence\DBAL\Page\Delete;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Delete\Repository\WriterInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

final class WriterRepository extends DBALRepository implements WriterInterface
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
