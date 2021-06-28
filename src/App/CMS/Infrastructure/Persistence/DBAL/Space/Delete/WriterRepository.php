<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Space\Delete;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use App\CMS\Domain\Space\Operation\Delete\Repository\WriterInterface;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function delete(SpaceId $id): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->delete('cms_space', 'space')
                ->where('space.id = :id')
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
