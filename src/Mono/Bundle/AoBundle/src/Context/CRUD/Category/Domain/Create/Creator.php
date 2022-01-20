<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\DataPersister\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\Exception\AlreadyExistingCategoryException;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\Exception\UnableToCreateException;

final class Creator implements CreatorInterface
{
    public function __construct(
        private CreatePersisterInterface $persister
    ) {
    }

    public function create(CategoryInterface $category): void
    {
        try {
            $this->persister->create($category);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingCategoryException($category->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException();
        }
    }
}
