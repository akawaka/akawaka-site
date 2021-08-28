<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Domain\Create;

use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Exception\AlreadyExistingSpaceException;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Space\Domain\Create\Repository\WriterInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

final class Creator implements CreatorInterface
{
    public function __construct(
        private WriterInterface $writer
    ) {
    }

    public function create(SpaceInterface $space): void
    {
        try {
            $this->writer->create($space);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingSpaceException($space->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException($exception->getMessage());
        }
    }
}
