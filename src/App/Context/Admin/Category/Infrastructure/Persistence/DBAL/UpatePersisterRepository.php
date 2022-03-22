<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Category\Domain\Update\DataPersister\Model\CategoryInterface;
use App\Context\Admin\Category\Domain\Update\DataPersister\UpatePersisterInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

class UpatePersisterRepository extends DBALRepository implements UpatePersisterInterface
{
    public function update(CategoryInterface $category): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_category')
                ->set('name', ':name')
                ->set('slug', ':slug')
                ->where('id = :id')
                ->setParameters([
                    'name' => $category->getName(),
                    'slug' => $category->getSlug()->getValue(),
                    'id' => $category->getId()->getValue(),
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
