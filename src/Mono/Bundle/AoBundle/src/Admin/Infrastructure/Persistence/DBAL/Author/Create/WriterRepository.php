<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Infrastructure\Persistence\DBAL\Author\Create;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Repository\WriterInterface;

class WriterRepository extends DBALRepository implements WriterInterface
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
