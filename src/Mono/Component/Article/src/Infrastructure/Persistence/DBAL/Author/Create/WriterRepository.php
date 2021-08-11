<?php

declare(strict_types=1);

namespace Mono\Component\Article\Infrastructure\Persistence\DBAL\Author\Create;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Article\Domain\Operation\Author\Create\Model\AuthorInterface;
use Mono\Component\Article\Domain\Operation\Author\Create\Repository\WriterInterface;

class WriterRepository extends DBALRepository implements WriterInterface
{
    public function create(AuthorInterface $author): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->insert('cms_author')
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
