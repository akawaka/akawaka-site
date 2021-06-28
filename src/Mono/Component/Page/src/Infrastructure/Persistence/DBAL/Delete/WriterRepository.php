<?php

declare(strict_types=1);

namespace Mono\Component\Page\Infrastructure\Persistence\DBAL\Delete;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Page\Domain\Operation\Delete\Repository\WriterInterface;
use Mono\Component\Page\Domain\Common\Identifier\PageId;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function delete(PageId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->delete('cms_page', 'page')
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
