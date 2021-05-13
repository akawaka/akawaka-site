<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Persistence\ORM\Channel;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindAllChannels extends ORMRepository implements Repository\FindAllChannels
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChannelInterface::class);
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
                SELECT channel
                FROM {$this->getClassName()} channel
            SQL);

        return $query->execute();
    }
}
