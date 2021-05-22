<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreatePage;

use App\CMS\Domain\Entity\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\Repository\FindChannelById;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository\CreatePage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindChannelById $channelReader,
        private CreatePage $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): PageInterface
    {
        $channels = new ArrayCollection();
        foreach ($command->getChannels() as $channel) {
            $channels->add($this->channelReader->find(new ChannelId($channel)));
        }

        $page = Page::create(
            $this->repository->nextIdentity(),
            $command->getSlug(),
            $command->getName(),
            $channels,
        );

        $this->repository->insert($page);
        $this->eventBus->dispatch(
            (new Envelope(new PageWasCreated($page->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $page;
    }
}
