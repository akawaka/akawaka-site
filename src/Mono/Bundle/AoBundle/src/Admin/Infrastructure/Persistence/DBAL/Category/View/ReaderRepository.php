<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Infrastructure\Persistence\DBAL\Category\View;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Category\View\Repository\ReaderInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;

final class ReaderRepository extends DBALRepository implements ReaderInterface
{
    public function get(CategoryId $id): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('category.*')
            ->from('ao_category', 'category')
            ->where('category.id = :id')
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
            ->from('ao_category', 'category')
            ->select('category.*')
            ->where('category.slug = :slug')
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
            ->select('category.*')
            ->from('ao_category', 'category')
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
