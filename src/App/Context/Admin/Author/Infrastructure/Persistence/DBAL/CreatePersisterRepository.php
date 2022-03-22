<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Author\Domain\Create\DataPersister\CreatePersisterInterface;
use App\Context\Admin\Author\Domain\Create\DataPersister\Model\AuthorInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

class CreatePersisterRepository extends DBALRepository implements CreatePersisterInterface
{
    public function create(AuthorInterface $author): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->insert('ao_author')
                ->values([
                    'id' => ':id',
                    'slug' => ':slug',
                    'name' => ':name',
                ])
                ->setParameters([
                    'id' => $author->getId()->getValue(),
                    'slug' => $author->getSlug()->getValue(),
                    'name' => $author->getName(),
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
