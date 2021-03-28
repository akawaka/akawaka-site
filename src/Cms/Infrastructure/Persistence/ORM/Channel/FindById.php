<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Channel;

use App\Cms\Domain\Entity\Channel;
use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Channel\Domain\Identifier\ChannelId;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Channel\Domain\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

final class FindById extends DoctrineRepository implements Repository\FindById
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Channel::class);
    }

    public function find(ChannelId $id): ChannelInterface
    {
        $query = $this->getQuery(<<<SQL
            SELECT channel
            FROM {$this->getClassName()} channel
            WHERE channel.id = :id
        SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('id', $id->getValue())
        ]));

        return $query->getSingleResult();
    }
}
