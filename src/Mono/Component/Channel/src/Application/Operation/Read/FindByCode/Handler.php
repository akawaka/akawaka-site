<?php

declare(strict_types=1);

namespace Mono\Component\Channel\Application\Operation\Read\FindByCode;

use Doctrine\ORM\NoResultException;
use Mono\Component\Channel\Domain\Entity\ChannelInterface;
use Mono\Component\Channel\Domain\Exception\ChannelNotFoundException;
use Mono\Component\Channel\Domain\Repository\FindChannelByCode;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    private FindChannelByCode $reader;

    public function __construct(
        FindChannelByCode $reader
    ) {
        $this->reader = $reader;
    }

    public function __invoke(Query $query): ChannelInterface
    {
        try {
            $channel = $this->reader->find($query->getCode());
        } catch (NoResultException $exception) {
            throw new ChannelNotFoundException($query->getCode()->getValue());
        }

        return $channel;
    }
}
