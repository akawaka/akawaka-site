<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Channel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindChannelByHostname extends ORMRepository implements Repository\FindChannelByHostname
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChannelInterface::class);
    }

    public function find(string $hostname): ChannelInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT channel
                FROM {$this->getClassName()} channel
                WHERE channel.url = :hostname
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('hostname', $hostname),
        ]));

        return $query->getSingleResult();
    }
}
