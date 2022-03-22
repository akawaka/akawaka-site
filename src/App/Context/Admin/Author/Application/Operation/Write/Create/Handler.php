<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Operation\Write\Create;

use App\Context\Admin\Author\Domain\Create\CreatorInterface;
use App\Context\Admin\Author\Domain\Create\DataPersister\Factory\BuilderInterface;
use App\Context\Admin\Author\Domain\Create\Exception\UnableToCreateException;
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
