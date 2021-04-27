<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Channel;

use App\CMS\Domain\Entity\Channel;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
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
