<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Exception\AlreadyExistingAuthorException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Create\Repository\WriterInterface;

final class Creator implements CreatorInterface
{
    public function __construct(
        private WriterInterface $writer
    ) {
    }

    public function create(AuthorInterface $author): void
    {
        try {
            $this->writer->create($author);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingAuthorException($author->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException();
        }
    }
}
