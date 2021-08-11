<?php

declare(strict_types=1);

namespace Mono\Component\Article\Infrastructure\Persistence\DBAL\Author\View;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;
use Mono\Component\Article\Domain\Operation\Author\View\Repository\ReaderInterface;
use Mono\Component\Article\Domain\Common\Identifier\AuthorId;

final class ReaderRepository extends DBALRepository implements ReaderInterface
{
    public function get(AuthorId $id): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('author.*')
            ->from('cms_author', 'author')
            ->where('author.id = :id')
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

        return $result;
    }

    public function getBySlug(Slug $slug): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->from('cms_author', 'author')
            ->select('author.*')
            ->where('author.slug = :slug')
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

        return $result;
    }

    public function getAll(): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('author.*')
            ->from('cms_author', 'author')
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
            ];
        }

        return $collection;
    }
}
