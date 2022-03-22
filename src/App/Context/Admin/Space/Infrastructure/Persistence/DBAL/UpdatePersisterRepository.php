<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Infrastructure\Persistence\DBAL;

use App\Context\Admin\Space\Domain\Update\DataPersister\Model\Space;
use Doctrine\DBAL\Exception;
use App\Context\Admin\Space\Domain\Update\DataPersister\Model\SpaceInterface;
use App\Context\Admin\Space\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class UpdatePersisterRepository extends DBALRepository implements UpdatePersisterInterface
{
    /**
     * @var Space
     */
    public function update(SpaceInterface $space): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_space')
                ->set('name', ':name')
                ->set('url', ':url')
                ->set('description', ':description')
                ->set('last_update', ':update')
                ->set('theme', ':theme')
                ->where('id = :id')
                ->setParameters([
                    'name' => $space->getName(),
                    'url' => $space->getUrl(),
                    'description' => $space->getDescription(),
                    'update' => (new \Safe\DateTimeImmutable())->format('Y-m-d H:i:s'),
                    'theme' => $space->getTheme(),
                    'id' => $space->getId()->getValue(),
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
