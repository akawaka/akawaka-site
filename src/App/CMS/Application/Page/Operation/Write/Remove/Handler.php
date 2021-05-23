<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Operation\Write\Remove;

use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository\FindPageById;
use Mono\Component\Page\Domain\Repository\RemovePage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindPageById $reader,
        private RemovePage $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): PageInterface
    {
        $page = $this->reader->find($command->getId());

        $this->writer->remove($page);
        $this->eventBus->dispatch(
            (new Envelope(new PageWasRemoved($page->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $page;
    }
}
