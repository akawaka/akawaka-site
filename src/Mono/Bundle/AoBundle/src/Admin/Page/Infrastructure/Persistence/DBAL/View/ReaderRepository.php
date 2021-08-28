<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Infrastructure\Persistence\DBAL\View;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Page\Domain\View\Repository\ReaderInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

final class ReaderRepository extends DBALRepository implements ReaderInterface
{
    public function get(PageId $id): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->select('
                page.*,
                space.id as space_id,
                space.name as space_name
            ')
            ->from('ao_page', 'page')
            ->leftJoin('page', 'ao_page_spaces', 'page_space', 'page.id = page_space.page_id')
            ->leftJoin('page_space', 'ao_space', 'space', 'space.id = page_space.space_id')
            ->where('page.id = :id')
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
        $builder = $this->getQueryBuilder();
        $builder
            ->select('
                page.*,
                space.id as space_id,
                space.name as space_name
            ')
            ->from('ao_page', 'page')
            ->leftJoin('page', 'ao_page_spaces', 'page_space', 'page.id = page_space.page_id')
            ->leftJoin('page_space', 'ao_space', 'space', 'space.id = page_space.space_id')
            ->where('page.slug = :slug')
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
        $builder = $this->getQueryBuilder();
        $builder
            ->select('
                page.*,
                space.id as space_id,
                space.name as space_name
            ')
            ->from('ao_page', 'page')
            ->leftJoin('page', 'ao_page_spaces', 'page_space', 'page.id = page_space.page_id')
            ->leftJoin('page_space', 'ao_space', 'space', 'space.id = page_space.space_id')
        ;

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

    private function format(array $result = []): array
    {
        $page = [
            'id' => $result['id'],
            'name' => $result['name'],
            'slug' => $result['slug'],
            'status' => $result['status'],
            'content' => $result['content'],
            'creation_date' => $result['creation_date'],
            'last_update' => $result['last_update'],
            'spaces' => [],
        ];

        if (null !== $result['space_id']) {
            $page['spaces'][$result['id']] = [
                'id' => $result['space_id'],
                'name' => $result['space_name'],
            ];
        }

        return $page;
    }
}
