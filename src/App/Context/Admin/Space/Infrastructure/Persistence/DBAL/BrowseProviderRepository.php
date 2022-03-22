<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Space\Domain\Browse\DataProvider\BrowseProviderInterface;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class BrowseProviderRepository extends DBALRepository implements BrowseProviderInterface
{
    public function browse(): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->from('ao_space', 'space')
            ->select('space.*')
        ;

        try {
            $statement = $builder->executeQuery();
        } catch (Exception $exception) {
            return [];
        }

        return $statement->fetchAllAssociative();
    }
}
