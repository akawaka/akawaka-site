<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Channel;

use App\Cms\Domain\Entity\Channel;
use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Channel\Domain\Repository;
use Doctrine\Persistence\ManagerRegistry;

final class Remove extends DoctrineRepository implements Repository\Remove
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Channel::class);
    }

    public function remove(ChannelInterface $channel): void
    {
        $this->manager->remove($channel);
        $this->manager->flush();
    }
}
