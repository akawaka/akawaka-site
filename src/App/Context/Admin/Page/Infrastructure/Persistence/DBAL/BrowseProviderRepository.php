<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Page\Domain\Browse\DataProvider\BrowseProviderInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class BrowseProviderRepository extends DBALRepository implements BrowseProviderInterface
{
    public function browse(): array
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
