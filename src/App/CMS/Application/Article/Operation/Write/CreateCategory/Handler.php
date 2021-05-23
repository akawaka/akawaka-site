<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Write\CreateCategory;

use App\CMS\Domain\Entity\Category;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository\CreateCategory;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CreateCategory $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): CategoryInterface
    {
        $category = Category::create(
            $this->repository->nextIdentity(),
            $command->getSlug(),
            $command->getName(),
        );

        $this->repository->insert($category);
        $this->eventBus->dispatch(
            (new Envelope(new CategoryWasCreated($category->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $category;
    }
}
