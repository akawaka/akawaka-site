<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Operation\Write\Update;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\DataPersister\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\Update\UpdaterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Space\Domain\View\ViewerInterface as SpaceViewer;
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
        private UpdaterInterface $updater,
        private MessageBusInterface $eventBus,
    ) {
    }

    public function __invoke(Command $command): void
    {
        $spaces = new ArrayCollection();
        foreach ($command->getSpaces() as $space) {
            $spaces->add($this->spaceReader->read(new SpaceId($space)));
        }

        $page = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'content' => $command->getContent(),
            'spaces' => $spaces->map(function (SpaceInterface $space) {
                return $space->getId()->getValue();
            })->toArray(),
        ]);

        try {
            $this->updater->update($page);
        } catch (UnableToUpdateException $exception) {
            throw $exception;
        }

        $this->eventBus->dispatch(
            (new Envelope(new PageWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );
    }
}
