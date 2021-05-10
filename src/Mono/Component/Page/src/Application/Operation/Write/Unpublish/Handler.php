<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Write\Unpublish;

use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository\FindPageById;
use Mono\Component\Page\Domain\Repository\UpdatePage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindPageById $reader,
        private UpdatePage $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): PageInterface
    {
        $page = $this->reader->find($command->getId());
        $page->unpublish();

        $this->writer->update($page);
        $this->eventBus->dispatch(
            (new Envelope(new PageWasUnpublished($page->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $page;
    }
}
