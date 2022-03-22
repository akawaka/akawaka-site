<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use App\Context\Admin\Article\Domain\Browse\DataProvider\BrowseProviderInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class BrowseProviderRepository extends DBALRepository implements BrowseProviderInterface
{
    public function browse(): array
    {
        $builder = $this->createQuery();

        try {
            $statement = $builder->executeQuery();
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
            ->from('ao_article', 'article')
            ->leftJoin('article', 'ao_article_categories', 'article_category', 'article.id = article_category.article_id')
            ->leftJoin('article_category', 'ao_category', 'category', 'category.id = article_category.category_id')
            ->leftJoin('article', 'ao_article_authors', 'article_author', 'article.id = article_author.article_id')
            ->leftJoin('article_author', 'ao_author', 'author', 'author.id = article_author.author_id')
            ->leftJoin('article', 'ao_article_spaces', 'article_space', 'article.id = article_space.article_id')
            ->leftJoin('article_space', 'ao_space', 'space', 'space.id = article_space.space_id')
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
            'status' => $result['status'],
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
