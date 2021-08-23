<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Write\Create;

use Mono\Component\Page\Domain\Operation\Create\CreatorInterface;
use Mono\Component\Page\Domain\Operation\Create\Exception\UnableToCreateException;
use Mono\Component\Page\Domain\Operation\Create\Factory\BuilderInterface;
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
        $page = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
        ]);

        try {
            $this->creator->create($page);
        } catch (UnableToCreateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new PageWasCreated($page->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
