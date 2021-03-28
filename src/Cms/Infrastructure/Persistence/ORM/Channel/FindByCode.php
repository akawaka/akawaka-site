<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Channel;

use App\Cms\Domain\Entity\Channel;
use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Channel\Domain\ValueObject\ChannelCode;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Channel\Domain\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

final class FindByCode extends DoctrineRepository implements Repository\FindByCode
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Channel::class);
    }

    public function find(ChannelCode $code): ChannelInterface
    {
        $query = $this->getQuery(<<<SQL
            SELECT channel
            FROM {$this->getClassName()} channel
            WHERE channel.code = :code
        SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('code', $code->getValue())
        ]));

        return $query->getSingleResult();
    }
}
