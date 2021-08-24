<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Write\Update;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Write\Update\PageWasUpdated;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\UpdaterInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Update\Exception\UnableToUpdateException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\Model\SpaceInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Space\View\ViewerInterface as SpaceViewer;
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
