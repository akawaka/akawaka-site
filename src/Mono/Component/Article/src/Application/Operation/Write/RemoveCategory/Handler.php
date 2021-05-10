<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\RemoveCategory;

use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository\FindCategoryById;
use Mono\Component\Article\Domain\Repository\RemoveCategory;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindCategoryById $reader,
        private RemoveCategory $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): CategoryInterface
    {
        $category = $this->reader->find($command->getCategoryId());

        $this->writer->remove($category);
        $this->eventBus->dispatch(
            (new Envelope(new CategoryWasRemoved($category->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $category;
    }
}
