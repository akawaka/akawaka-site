<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UpdateCategory;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository\FindCategoryById;
use Mono\Component\Article\Domain\Repository\UpdateCategory;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindCategoryById $reader,
        private UpdateCategory $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): CategoryInterface
    {
        $category = $this->reader->find($command->getCategoryId());
        $category->update(
            $command->getName(),
            $command->getSlug(),
        );

        $this->writer->update($category);
        $this->eventBus->dispatch(
            (new Envelope(new CategoryWasUpdated($category->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $category;
    }
}
