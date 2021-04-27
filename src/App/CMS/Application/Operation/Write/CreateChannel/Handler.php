<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateChannel;

use App\CMS\Domain\Entity\Channel;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Repository\Create;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private Create $repository,
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
        $this->eventBus->dispatch(new ChannelWasCreated($channel));

        return $channel;
    }
}
