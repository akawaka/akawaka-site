<?php

declare(strict_types=1);

namespace Mono\Component\Article\Infrastructure\Persistence\DBAL\Author\Update;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Article\Domain\Operation\Author\Update\Model\AuthorInterface;
use Mono\Component\Article\Domain\Operation\Author\Update\Repository\WriterInterface;

class WriterRepository extends DBALRepository implements WriterInterface
{
    public function update(AuthorInterface $author): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('cms_author')
                ->set('name', ':name')
                ->set('slug', ':slug')
                ->where('id = :id')
                ->setParameters([
                    'name' => $author->getName(),
                    'slug' => $author->getSlug()->getValue(),
                    'id' => $author->getId()->getValue(),
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
