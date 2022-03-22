<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Operation\Write\Update;

use Doctrine\Common\Collections\ArrayCollection;
use App\Context\Admin\Page\Domain\Update\DataPersister\Factory\BuilderInterface;
use App\Context\Admin\Page\Domain\Update\Exception\UnableToUpdateException;
use App\Context\Admin\Page\Domain\Update\UpdaterInterface;
use App\Context\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use App\Context\Admin\Space\Domain\View\ViewerInterface as SpaceViewer;
use App\Shared\Domain\Identifier\SpaceId;
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
