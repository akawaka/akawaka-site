<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Application\Operation\Write\Create;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\CreatorInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Page\Domain\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Space\Domain\View\ViewerInterface as SpaceViewer;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private SpaceViewer $spaceReader,
        private BuilderInterface $builder,
        private CreatorInterface $creator,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): bool
    {
        $spaces = new ArrayCollection();
        foreach ($command->getSpaces() as $space) {
            $spaces->add($this->spaceReader->read(new SpaceId($space)));
        }

        $page = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'spaces' => $spaces,
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

        return true;
    }
}
