<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Channel;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class CreateChannel extends ORMRepository implements Repository\CreateChannel
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChannelInterface::class);
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
