<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UpdateCategory;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository\UpdateCategory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private UpdateCategory $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): CategoryInterface
    {
        $entity = $command->getCategory();
        $entity->update(
            $command->getName(),
            $command->getSlug(),
        );

        $this->repository->update($entity);
        $this->eventBus->dispatch(new CategoryWasUpdated($entity));

        return $entity;
    }
}
