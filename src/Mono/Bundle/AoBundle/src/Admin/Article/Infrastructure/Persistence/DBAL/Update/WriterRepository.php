<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Infrastructure\Persistence\DBAL\Update;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Update\Repository\WriterInterface;

final class WriterRepository extends DBALRepository implements WriterInterface
{
    public function update(ArticleInterface $article): bool
    {
        $this->beginTransaction();

        try {
            $builder = $this->getQueryBuilder();
            $builder
                ->update('ao_article')
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
                ->delete('ao_article_spaces')
                ->where('article_id = :id')
                ->setParameters([
                    'id' => $article->getId()->getValue(),
                ])
                ->execute()
            ;

            $builder
                ->delete('ao_article_categories')
                ->where('article_id = :id')
                ->setParameters([
                    'id' => $article->getId()->getValue(),
                ])
                ->execute()
            ;

            $builder
                ->delete('ao_article_authors')
                ->where('article_id = :id')
                ->setParameters([
                    'id' => $article->getId()->getValue(),
                ])
                ->execute()
            ;

            foreach ($article->getCategories() as $category) {
                $builder
                    ->insert('ao_article_categories')
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

            foreach ($article->getAuthors() as $author) {
                $builder
                    ->insert('ao_article_authors')
                    ->values([
                        'article_id' => ':id',
                        'author_id' => ':author',
                    ])
                    ->setParameters([
                        'id' => $article->getId()->getValue(),
                        'author' => $author,
                    ])
                    ->execute()
                ;
            }

            foreach ($article->getSpaces() as $space) {
                $builder
                    ->insert('ao_article_spaces')
                    ->values([
                        'article_id' => ':id',
                        'space_id' => ':space',
                    ])
                    ->setParameters([
                        'id' => $article->getId()->getValue(),
                        'space' => $space,
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
