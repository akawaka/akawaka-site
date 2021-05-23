<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Read\FindById;

use Doctrine\ORM\NoResultException;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Exception\SpaceNotFoundException;
use Mono\Component\Space\Domain\Repository\FindSpaceById;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindSpaceById $reader
    ) {
    }

    public function __invoke(Query $query): SpaceInterface
    {
        try {
            $space = $this->reader->find($query->getId());
        } catch (NoResultException $exception) {
            throw new SpaceNotFoundException($query->getId()->getValue());
        }

        return $space;
    }
}
