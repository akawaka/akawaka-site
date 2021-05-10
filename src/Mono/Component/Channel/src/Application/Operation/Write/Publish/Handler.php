<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Write\Publish;

use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Repository\FindChannelById;
use Mono\Component\Channel\Domain\Repository\UpdateChannel;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindChannelById $reader,
        private UpdateChannel $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ChannelInterface
    {
        $channel = $this->reader->find($command->getId());
        $channel->publish();

        $this->writer->update($channel);
        $this->eventBus->dispatch(
            (new Envelope(new ChannelWasPublished($channel->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $channel;
    }
}
