<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Page\Operation\Write\Update;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Page\Application\Operation\Write\Update\PageWasUpdated;
use Mono\Component\Page\Domain\Operation\Update\Factory\BuilderInterface;
use Mono\Component\Page\Domain\Operation\Update\UpdaterInterface;
use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Component\Page\Domain\Operation\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Domain\Space\Operation\View\ViewerInterface as SpaceViewer;
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
            'content' => $command->getContent(),
            'spaces' => $spaces->map(function (SpaceInterface $space) {
                return $space->getId()->getValue();
            })->toArray(),
        ]);

        try {
            $this->updater->update($page);
        } catch (UnableToUpdateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new PageWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
