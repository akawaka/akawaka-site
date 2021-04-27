<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateCategory;

use App\CMS\Domain\Entity\Category;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository\CreateCategory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CreateCategory $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): CategoryInterface
    {
        $entity = Category::create(
            $this->repository->nextIdentity(),
            $command->getSlug(),
            $command->getName(),
        );

        $this->repository->insert($entity);
        $this->eventBus->dispatch(new CategoryWasCreated($entity));

        return $entity;
    }
}
