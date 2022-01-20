<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class ViewProviderRepository extends DBALRepository implements ViewProviderInterface
{
    public function get(AuthorId $id): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('author.*')
            ->from('ao_author', 'author')
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
            ->from('ao_author', 'author')
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
            ->from('ao_author', 'author')
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
