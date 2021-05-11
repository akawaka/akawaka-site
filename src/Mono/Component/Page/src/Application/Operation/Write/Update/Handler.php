<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Write\Update;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\Repository\FindChannelById;
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
        private FindChannelById $channelReader,
        private FindPageById $reader,
        private UpdatePage $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): PageInterface
    {
        $channels = new ArrayCollection();
        foreach ($command->getChannels() as $channel) {
            $channels->add($this->channelReader->find(new ChannelId($channel)));
        }

        $page = $this->reader->find($command->getId());

        $page->update(
            $command->getName(),
            $command->getSlug(),
            $channels,
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
