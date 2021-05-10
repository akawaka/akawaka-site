<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Read\FindById;

use Doctrine\ORM\NoResultException;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Exception\ChannelNotFoundException;
use Mono\Component\Channel\Domain\Repository\FindChannelById;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindChannelById $reader
    ) {
    }

    public function __invoke(Query $query): ChannelInterface
    {
        try {
            $channel = $this->reader->find($query->getId());
        } catch (NoResultException $exception) {
            throw new ChannelNotFoundException($query->getId()->getValue());
        }

        return $channel;
    }
}
