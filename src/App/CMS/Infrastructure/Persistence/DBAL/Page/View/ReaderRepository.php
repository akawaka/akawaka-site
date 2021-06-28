<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Page\View;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Component\Page\Domain\Common\ValueObject\PageSlug;
use Mono\Component\Page\Domain\Operation\View\Repository\ReaderInterface;
use Mono\Component\Page\Domain\Common\Identifier\PageId;

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
            ->from('cms_page', 'page')
            ->leftJoin('page', 'cms_page_spaces', 'page_space', 'page.id = page_space.page_id')
            ->leftJoin('page_space', 'cms_space', 'space', 'space.id = page_space.space_id')
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

        $results = $statement->fetchAllAssociative();
        $collection = [];
        foreach ($results as $result) {
            $collection[$result['id']] ??= [
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
                $collection[$result['id']]['spaces'][] = [
                    'id' => $result['space_id'],
                    'name' => $result['space_name'],
                ];
            }
        }

        return reset($collection);
    }

    public function getBySlug(PageSlug $slug): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->from('cms_page', 'page')
            ->select('page.*')
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

        return $statement->fetchAssociative();
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
            ->from('cms_page', 'page')
            ->leftJoin('page', 'cms_page_spaces', 'page_space', 'page.id = page_space.page_id')
            ->leftJoin('page_space', 'cms_space', 'space', 'space.id = page_space.space_id')
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
                'status' => $result['status'],
                'content' => $result['content'],
                'creation_date' => $result['creation_date'],
                'last_update' => $result['last_update'],
                'spaces' => [],
            ];

            if (null !== $result['space_id']) {
                $collection[$result['id']]['spaces'][] = [
                    'id' => $result['space_id'],
                    'name' => $result['space_name'],
                ];
            }
        }

        return $collection;
    }
}
