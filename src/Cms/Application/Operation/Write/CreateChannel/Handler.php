<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\CreateChannel;

use App\Cms\Domain\Entity\Channel;
use Black\Component\Channel\Domain\Entity\ChannelInterface;
use Black\Component\Channel\Domain\Repository\Create;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    private Create $repository;

    private MessageBusInterface $bus;

    public function __construct(
        Create $repository,
        MessageBusInterface $eventBus
    ) {
        $this->repository = $repository;
        $this->bus = $eventBus;
    }

    public function __invoke(Command $command): ChannelInterface
    {
        $channel = Channel::create(
            $this->repository->nextIdentity(),
            $command->getCode(),
            $command->getName(),
        );

        $this->repository->insert($channel);

        $this->bus->dispatch(new Event($channel));

        return $channel;
    }
}
