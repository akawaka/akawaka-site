<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class UpdatePersisterRepository extends DBALRepository implements UpdatePersisterInterface
{
    public function update(
        SpaceId $id,
        string $name,
        ?string $url,
        ?string $description,
        ?string $theme,
    ): bool {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_space')
                ->set('name', ':name')
                ->set('url', ':url')
                ->set('description', ':description')
                ->set('theme', ':theme')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'name' => $name,
                    'url' => $url,
                    'description' => $description,
                    'theme' => $theme,
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
