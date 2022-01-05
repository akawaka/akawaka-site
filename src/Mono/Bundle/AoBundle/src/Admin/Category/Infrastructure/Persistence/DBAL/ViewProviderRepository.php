<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use Mono\Bundle\AoBundle\Admin\Category\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class ViewProviderRepository extends DBALRepository implements ViewProviderInterface
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
