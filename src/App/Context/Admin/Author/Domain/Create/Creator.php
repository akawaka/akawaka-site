<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use App\Context\Admin\Author\Domain\Create\DataPersister\CreatePersisterInterface;
use App\Context\Admin\Author\Domain\Create\DataPersister\Model\AuthorInterface;
use App\Context\Admin\Author\Domain\Create\Exception\AlreadyExistingAuthorException;
use App\Context\Admin\Author\Domain\Create\Exception\UnableToCreateException;

final class Creator implements CreatorInterface
{
    public function __construct(
        private CreatePersisterInterface $persister
    ) {
    }

    public function create(AuthorInterface $author): void
    {
        try {
            $this->persister->create($author);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingAuthorException($author->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException();
        }
    }
}
