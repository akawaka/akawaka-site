<?php

declare(strict_types=1);

namespace App\CMS\Domain\Space\Operation\Create;

use App\CMS\Domain\Space\Operation\Create\Exception\UnableToCreateException;
use App\CMS\Domain\Space\Operation\Create\Exception\AlreadyExistingSpaceException;
use App\CMS\Domain\Space\Operation\Create\Model\SpaceInterface;
use App\CMS\Domain\Space\Operation\Create\Repository\WriterInterface;
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
