<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Category\Write\Create;

use Mono\Component\Article\Domain\Operation\Category\Create\CreatorInterface;
use Mono\Component\Article\Domain\Operation\Category\Create\Exception\UnableToCreateException;
use Mono\Component\Article\Domain\Operation\Category\Create\Factory\BuilderInterface;
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

    public function __invoke(Command $command): bool
    {
        $category = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
        ]);

        try {
            $this->creator->create($category);
        } catch (UnableToCreateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new CategoryWasCreated($category->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
