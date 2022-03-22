<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Author\Domain\Update\DataPersister\Model\AuthorInterface;
use App\Context\Admin\Author\Domain\Update\DataPersister\UpdatePersisterInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

class UpdatePersisterRepository extends DBALRepository implements UpdatePersisterInterface
{
    public function update(AuthorInterface $author): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_author')
                ->set('name', ':name')
                ->set('slug', ':slug')
                ->where('id = :id')
                ->setParameters([
                    'name' => $author->getName(),
                    'slug' => $author->getSlug()->getValue(),
                    'id' => $author->getId()->getValue(),
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
