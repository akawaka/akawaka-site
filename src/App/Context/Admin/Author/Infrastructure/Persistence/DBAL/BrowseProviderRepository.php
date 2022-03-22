<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Author\Domain\Browse\DataProvider\BrowseProviderInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class BrowseProviderRepository extends DBALRepository implements BrowseProviderInterface
{
    public function browse(): array
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
