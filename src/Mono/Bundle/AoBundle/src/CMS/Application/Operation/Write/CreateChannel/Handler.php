<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Application\Operation\Write\CreateChannel;

use Mono\Bundle\AoBundle\CMS\Domain\Entity\Channel;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Repository\CreateChannel;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private CreateChannel $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ChannelInterface
    {
        $channel = Channel::create(
            $this->repository->nextIdentity(),
            $command->getCode(),
            $command->getName(),
        );

        $this->repository->insert($channel);
        $this->eventBus->dispatch(
            (new Envelope(new ChannelWasCreated($channel->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $channel;
    }
}
