<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Space\Publish;

use Doctrine\DBAL;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Space\Domain\Operation\Publish\ReaderInterface;
use Mono\Component\Space\Domain\Common\Identifier\SpaceId;

final class ReaderRepository extends DBALRepository implements ReaderInterface
{
    public function exists(SpaceId $id): bool
    {
        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->select('COUNT(1)')
                ->from('cms_space', 'space')
                ->where('space.id = :id')
                ->setParameters([
                    'id' => $id->getValue(),
                ]);

            $statement = $builder->execute();
        } catch (DBAL\Exception $exception) {
            return false;
        }

        try {
            $count = $statement->fetchOne();
        } catch (DBAL\Driver\Exception $exception) {
            return false;
        }

        return $count === 1;
    }
}
