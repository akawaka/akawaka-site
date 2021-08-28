<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Application\Operation\Write\Create;

use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\CreatorInterface;
use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Author\Domain\Create\Factory\BuilderInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private CreatorInterface $creator,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): void
    {
        $author = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
        ]);

        try {
            $this->creator->create($author);
        } catch (UnableToCreateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new AuthorWasCreated($author->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
