<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\DBAL\Space\View;

use Doctrine\DBAL\Exception;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DBALRepository;
use App\CMS\Domain\Space\Common\ValueObject\SpaceCode;
use App\CMS\Domain\Space\Operation\View\ReaderInterface;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;

final class ReaderRepository extends DBALRepository implements ReaderInterface
{
    public function get(SpaceId $id): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->from('cms_space', 'space')
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

    public function getByCode(SpaceCode $code): array
    {
        $builder = $this->getQueryBuilder();
        $builder
            ->from('cms_space', 'space')
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
            ->from('cms_space', 'space')
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
            ->from('cms_space', 'space')
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
