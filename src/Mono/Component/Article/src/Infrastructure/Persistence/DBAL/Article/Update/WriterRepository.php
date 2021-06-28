<?php

declare(strict_types=1);

namespace Mono\Component\Article\Infrastructure\Persistence\DBAL\Article\Update;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Article\Domain\Operation\Article\Update\Model\ArticleInterface;
use Mono\Component\Article\Domain\Operation\Article\Update\Repository\WriterInterface;

class WriterRepository extends DBALRepository implements WriterInterface
{
    public function update(ArticleInterface $article): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('cms_article')
                ->set('name', ':name')
                ->set('slug', ':slug')
                ->set('content', ':content')
                ->set('last_update', ':update')
                ->where('id = :id')
                ->setParameters([
                    'name' => $article->getName(),
                    'slug' => $article->getSlug()->getValue(),
                    'content' => $article->getContent(),
                    'update' => (new \Safe\DateTimeImmutable())->format('Y-m-d H:i:s'),
                    'id' => $article->getId()->getValue(),
                ])
                ->execute()
            ;

            $builder
                ->delete('article_categories')
                ->where('article_id = :id')
                ->setParameters([
                    'id' => $article->getId()->getValue(),
                ])
                ->execute()
            ;

            foreach ($article->getCategories() as $category) {
                $builder
                    ->insert('article_categories')
                    ->values([
                        'article_id' => ':id',
                        'category_id' => ':category',
                    ])
                    ->setParameters([
                        'id' => $article->getId()->getValue(),
                        'category' => $category,
                    ])
                    ->execute()
                ;
            }

            $this->getConnection()->commit();
        } catch (Exception $exception) {
            $this->getConnection()->rollback();

            throw $exception;
        }

        return true;
    }
}
