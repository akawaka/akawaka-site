<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Infrastructure\Persistence\DBAL\Space\View;

use Doctrine\DBAL\Exception;
use Mono\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DBALRepository;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Code;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\ReaderInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;

final class ReaderRepository extends DBALRepository implements ReaderInterface
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
            $statement = $builder->execute();
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
            $statement = $builder->execute();
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
            ->from('ao_space', 'space')
            ->select('space.*')
        ;

        try {
            $statement = $builder->execute();
        } catch (Exception $exception) {
            return [];
        }

        return $statement->fetchAllAssociative();
    }
}
