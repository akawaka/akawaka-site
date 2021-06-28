<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Space\Create;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use App\CMS\Domain\Space\Operation\Create\Model\SpaceInterface;
use App\CMS\Domain\Space\Operation\Create\Repository\WriterInterface;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function create(SpaceInterface $space): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->insert('cms_space')
                ->values([
                    'id' => ':id',
                    'code' => ':code',
                    'name' => ':name',
                    'status' => ':status',
                    'creation_date' => ':creation_date',
                ])
                ->setParameters([
                    'id' => $space->getId()->getValue(),
                    'code' => $space->getCode()->getValue(),
                    'name' => $space->getName(),
                    'status' => $space->getStatus(),
                    'creation_date' => $space->getCreationDate()->format('Y-m-d H:i:s'),
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
