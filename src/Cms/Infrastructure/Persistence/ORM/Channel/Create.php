<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Channel;

use App\Cms\Domain\Entity\Channel;
use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Channel\Domain\Identifier\ChannelId;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Channel\Domain\Repository;
use Doctrine\Persistence\ManagerRegistry;

final class Create extends DoctrineRepository implements Repository\Create
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Channel::class);
    }

    public function insert(ChannelInterface $channel): void
    {
        $this->manager->persist($channel);
        $this->manager->flush();
    }

    public function nextIdentity(): ChannelId
    {
        return new ChannelId();
    }
}
