<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Infrastructure\Persistence\DBAL\Create;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Repository\WriterInterface;

class WriterRepository extends DBALRepository implements WriterInterface
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
