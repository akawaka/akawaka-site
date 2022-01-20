<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\DataPersister\Model\UserInterface;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\Exception\AlreadyExistingUserException;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\Exception\UnableToCreateException;

final class Creator implements CreatorInterface
{
    public function __construct(
        private CreatePersisterInterface $persister,
    ) {
    }

    public function create(UserInterface $user): void
    {
        try {
            $this->persister->create($user);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingUserException($user->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException();
        }
    }
}
