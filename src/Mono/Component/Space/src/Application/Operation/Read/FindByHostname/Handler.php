<?php

declare(strict_types=1);

namespace Mono\Component\Space\Application\Operation\Read\FindByHostname;

use Doctrine\ORM\NoResultException;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Exception\SpaceNotFoundException;
use Mono\Component\Space\Domain\Repository\FindSpaceByHostname;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    private FindSpaceByHostname $reader;

    public function __construct(
        FindSpaceByHostname $reader
    ) {
        $this->reader = $reader;
    }

    public function __invoke(Query $query): SpaceInterface
    {
        try {
            $space = $this->reader->find($query->getHostname());
        } catch (NoResultException $exception) {
            throw new SpaceNotFoundException($query->getHostname());
        }

        return $space;
    }
}
