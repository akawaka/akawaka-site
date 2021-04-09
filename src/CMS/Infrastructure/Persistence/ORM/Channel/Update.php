<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Channel;

use App\CMS\Domain\Entity\Channel;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
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
