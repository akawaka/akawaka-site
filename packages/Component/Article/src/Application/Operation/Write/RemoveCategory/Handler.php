<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\RemoveCategory;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository\RemoveCategory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private RemoveCategory $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): CategoryInterface
    {
        $entity = $command->getCategory();

        $this->repository->remove($entity);
        $this->eventBus->dispatch(new CategoryWasRemoved($entity));

        return $entity;
    }
}
