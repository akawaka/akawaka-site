<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\DataPersister\Model\CategoryInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

class CreatePersisterRepository extends DBALRepository implements CreatePersisterInterface
{
    public function create(CategoryInterface $category): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->insert('ao_category')
                ->values([
                    'id' => ':id',
                    'slug' => ':slug',
                    'name' => ':name',
                ])
                ->setParameters([
                    'id' => $category->getId()->getValue(),
                    'slug' => $category->getSlug()->getValue(),
                    'name' => $category->getName(),
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
