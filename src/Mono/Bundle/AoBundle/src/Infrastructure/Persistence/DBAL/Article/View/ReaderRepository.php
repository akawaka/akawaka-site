<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Persistence\DBAL\Article\View;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Article\View\Repository\ReaderInterface;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class ReaderRepository extends DBALRepository implements ReaderInterface
{
    public function get(ArticleId $id): array
    {
        $builder = $this->createQuery()
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

        return $this->format($result);
    }

    public function getBySlug(Slug $slug): array
    {
        $builder = $this->createQuery()
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

        return $this->format($result);
    }

    public function getAll(): array
    {
        $builder = $this->createQuery();

        try {
            $statement = $builder->execute();
        } catch (Exception $exception) {
            return [];
        }

        $results = $statement->fetchAllAssociative();
        $collection = [];

        foreach ($results as $result) {
            $collection[$result['id']] ??= $this->format($result);
        }

        return $collection;
    }

    private function createQuery(): QueryBuilder
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('
                article.*,
                category.id as category_id,
                category.name as category_name,
                category.slug as category_slug,
                author.id as author_id,
                author.name as author_name,
                author.slug as author_slug,
                space.id as space_id,
                space.name as space_name
            ')
            ->from('cms_article', 'article')
            ->leftJoin('article', 'cms_article_categories', 'article_category', 'article.id = article_category.article_id')
            ->leftJoin('article_category', 'cms_category', 'category', 'category.id = article_category.category_id')
            ->leftJoin('article', 'cms_article_authors', 'article_author', 'article.id = article_author.article_id')
            ->leftJoin('article_author', 'cms_author', 'author', 'author.id = article_author.author_id')
            ->leftJoin('article', 'cms_article_spaces', 'article_space', 'article.id = article_space.article_id')
            ->leftJoin('article_space', 'cms_space', 'space', 'space.id = article_space.space_id')
        ;

        return $builder;
    }

    private function format(array $result = []): array
    {
        $article = [
            'id' => $result['id'],
            'name' => $result['name'],
            'slug' => $result['slug'],
            'content' => $result['content'],
            'creation_date' => $result['creation_date'],
            'last_update' => $result['last_update'],
            'categories' => [],
            'authors' => [],
            'spaces' => [],
        ];

        if (null !== $result['category_id']) {
            $article['categories'][$result['category_id']] = [
                'id' => $result['category_id'],
                'name' => $result['category_name'],
                'slug' => $result['category_slug'],
            ];
        }

        if (null !== $result['author_id']) {
            $article['authors'][$result['author_id']] = [
                'id' => $result['author_id'],
                'name' => $result['author_name'],
                'slug' => $result['author_slug'],
            ];
        }

        if (null !== $result['space_id']) {
            $article[$result['id']]['spaces'][] = [
                'id' => $result['space_id'],
                'name' => $result['space_name'],
            ];
        }

        return $article;
    }
}
