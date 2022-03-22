<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Infrastructure\Persistence\DBAL;

use Doctrine\DBAL\Exception;
use App\Context\Admin\Space\Domain\View\DataProvider\ViewProviderInterface;
use App\Shared\Domain\Identifier\SpaceId;
use App\Shared\Domain\ValueObject\Code;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;

final class ViewProviderRepository extends DBALRepository implements ViewProviderInterface
{
    public function get(SpaceId $id): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->from('ao_space', 'space')
            ->select('space.*')
            ->where('space.id = :id')
            ->setParameters([
                'id' => $id->getValue(),
            ])
        ;

        try {
            $statement = $builder->executeQuery();
        } catch (Exception $exception) {
            return [];
        }

        return $statement->fetchAssociative();
    }

    public function getByCode(Code $code): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->from('ao_space', 'space')
            ->select('space.*')
            ->where('space.code = :code')
            ->setParameters([
                'code' => $code->getValue(),
            ])
        ;

        try {
            $statement = $builder->executeQuery();
        } catch (Exception $exception) {
            return [];
        }

        return $statement->fetchAssociative();
    }

    public function getByHostname(string $hostname): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->from('ao_space', 'space')
            ->select('space.*')
            ->where('space.url = :hostname')
            ->setParameters([
                'hostname' => $hostname,
            ])
        ;

        try {
            $statement = $builder->executeQuery();
        } catch (Exception $exception) {
            return [];
        }

        return $statement->fetchAssociative();
    }
}
