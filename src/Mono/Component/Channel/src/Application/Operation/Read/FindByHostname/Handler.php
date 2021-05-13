<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Read\FindByHostname;

use Doctrine\ORM\NoResultException;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Exception\ChannelNotFoundException;
use Mono\Component\Channel\Domain\Repository\FindChannelByHostname;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    private FindChannelByHostname $reader;

    public function __construct(
        FindChannelByHostname $reader
    ) {
        $this->reader = $reader;
    }

    public function __invoke(Query $query): ChannelInterface
    {
        try {
            $channel = $this->reader->find($query->getHostname());
        } catch (NoResultException $exception) {
            throw new ChannelNotFoundException($query->getHostname());
        }

        return $channel;
    }
}
