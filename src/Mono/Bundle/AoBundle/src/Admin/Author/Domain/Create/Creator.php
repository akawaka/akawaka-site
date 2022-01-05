<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\DataPersister\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\Exception\AlreadyExistingAuthorException;
use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\Exception\UnableToCreateException;

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
