<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Write\Update;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Space\Domain\Identifier\SpaceId;
use Mono\Component\Space\Domain\Repository\FindSpaceById;
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
        private FindSpaceById $spaceReader,
        private FindPageById $reader,
        private UpdatePage $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): PageInterface
    {
        $spaces = new ArrayCollection();
        foreach ($command->getSpaces() as $space) {
            $spaces->add($this->spaceReader->find(new SpaceId($space)));
        }

        $page = $this->reader->find($command->getId());

        $page->update(
            $command->getName(),
            $command->getSlug(),
            $spaces,
            $command->getContent(),
        );

        $this->writer->update($page);
        $this->eventBus->dispatch(
            (new Envelope(new PageWasUpdated($page->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $page;
    }
}
