<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Persistence\ORM\Channel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindChannelById extends ORMRepository implements Repository\FindChannelById
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChannelInterface::class);
    }

    public function find(ChannelId $id): ChannelInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT channel
                FROM {$this->getClassName()} channel
                WHERE channel.id = :id
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('id', $id->getValue()),
        ]));

        return $query->getSingleResult();
    }
}
