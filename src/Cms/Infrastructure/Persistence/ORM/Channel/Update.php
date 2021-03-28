<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Channel;

use App\Cms\Domain\Entity\Channel;
use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Channel\Domain\Repository;
use Doctrine\Persistence\ManagerRegistry;

final class Update extends DoctrineRepository implements Repository\Update
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Channel::class);
    }

    public function update(ChannelInterface $channel): void
    {
        $this->manager->flush();
    }
}
