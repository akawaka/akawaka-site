<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Read\FindByCode;

use Doctrine\ORM\NoResultException;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Exception\SpaceNotFoundException;
use Mono\Component\Space\Domain\Repository\FindSpaceByCode;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    private FindSpaceByCode $reader;

    public function __construct(
        FindSpaceByCode $reader
    ) {
        $this->reader = $reader;
    }

    public function __invoke(Query $query): SpaceInterface
    {
        try {
            $space = $this->reader->find($query->getCode());
        } catch (NoResultException $exception) {
            throw new SpaceNotFoundException($query->getCode()->getValue());
        }

        return $space;
    }
}
