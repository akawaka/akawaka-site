<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Persistence\ORM\Channel;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class RemoveChannel extends ORMRepository implements Repository\RemoveChannel
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChannelInterface::class);
    }

    public function remove(ChannelInterface $channel): void
    {
        $this->manager->remove($channel);
        $this->manager->flush();
    }
}
