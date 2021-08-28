<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Infrastructure\Persistence\DBAL\Update;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Update\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Update\Repository\WriterInterface;

class WriterRepository extends DBALRepository implements WriterInterface
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
