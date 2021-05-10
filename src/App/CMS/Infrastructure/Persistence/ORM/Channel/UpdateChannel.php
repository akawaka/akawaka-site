<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Channel;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class UpdateChannel extends ORMRepository implements Repository\UpdateChannel
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChannelInterface::class);
    }

    public function update(ChannelInterface $channel): void
    {
        $this->manager->flush();
    }
}
