<?php

declare(strict_types=1);

namespace Mono\Component\Article\Infrastructure\Persistence\DBAL\Article\View;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Article\View\Repository\ReaderInterface;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class ReaderRepository extends DBALRepository implements ReaderInterface
{
    public function get(ArticleId $id): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('
                article.*,
                category.id as category_id,
                category.name as category_name,
                category.slug as category_slug
            ')
            ->from('cms_article', 'article')
            ->leftJoin('article', 'cms_article_categories', 'article_category', 'article.id = article_category.article_id')
            ->leftJoin('article_category', 'cms_category', 'category', 'category.id = article_category.category_id')
            ->where('article.id = :id')
            ->setParameters([
                'id' => $id->getValue(),
            ])
        ;

        try {
            $statement = $builder->execute();
        } catch (Exception $exception) {
            return [];
        }

        if (false === $result = $statement->fetchAssociative()) {
            return [];
        }

        $article = [
            'id' => $result['id'],
            'name' => $result['name'],
            'slug' => $result['slug'],
            'content' => $result['content'],
            'creation_date' => $result['creation_date'],
            'last_update' => $result['last_update'],
            'categories' => [],
        ];

        if (null !== $result['category_id']) {
            $article['categories'][$result['category_id']] = [
                'id' => $result['category_id'],
                'name' => $result['category_name'],
                'slug' => $result['category_slug'],
            ];
        }

        return $article;
    }

    public function getBySlug(Slug $slug): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('
                article.*,
                category.id as category_id,
                category.name as category_name,
                category.slug as category_slug
            ')
            ->from('cms_article', 'article')
            ->leftJoin('article', 'cms_article_categories', 'article_category', 'article.id = article_category.article_id')
            ->leftJoin('article_category', 'cms_category', 'category', 'category.id = article_category.category_id')
            ->where('article.slug = :slug')
            ->setParameters([
                'slug' => $slug->getValue(),
            ])
        ;

        try {
            $statement = $builder->execute();
        } catch (Exception $exception) {
            return [];
        }

        if (false === $result = $statement->fetchAssociative()) {
            return [];
        }

        $article = [
            'id' => $result['id'],
            'name' => $result['name'],
            'slug' => $result['slug'],
            'content' => $result['content'],
            'creation_date' => $result['creation_date'],
            'last_update' => $result['last_update'],
            'categories' => [],
        ];

        if (null !== $result['category_id']) {
            $article['categories'][$result['category_id']] = [
                'id' => $result['category_id'],
                'name' => $result['category_name'],
                'slug' => $result['category_slug'],
            ];
        }

        return $article;
    }

    public function getAll(): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('
                article.*,
                category.id as category_id,
                category.name as category_name,
                category.slug as category_slug
            ')
            ->from('cms_article', 'article')
            ->leftJoin('article', 'cms_article_categories', 'article_category', 'article.id = article_category.article_id')
            ->leftJoin('article_category', 'cms_category', 'category', 'category.id = article_category.category_id')
        ;

        try {
            $statement = $builder->execute();
        } catch (Exception $exception) {
            return [];
        }

        $results = $statement->fetchAllAssociative();
        $collection = [];

        foreach ($results as $result) {
            $collection[$result['id']] ??= [
                'id' => $result['id'],
                'name' => $result['name'],
                'slug' => $result['slug'],
                'content' => $result['content'],
                'creation_date' => $result['creation_date'],
                'last_update' => $result['last_update'],
                'categories' => [],
            ];

            if (null !== $result['category_id']) {
                $collection[$result['id']]['categories'][] = [
                    'id' => $result['category_id'],
                    'name' => $result['category_name'],
                    'slug' => $result['category_slug'],
                ];
            }
        }

        return $collection;
    }
}
