<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\DataPersister\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Exception\AlreadyExistingSpaceException;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Exception\UnableToCreateException;

final class Creator implements CreatorInterface
{
    public function __construct(
        private CreatePersisterInterface $persister
    ) {
    }

    public function create(SpaceInterface $space): void
    {
        try {
            $this->persister->create($space);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingSpaceException($space->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException($exception->getMessage());
        }
    }
}
