<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Write\Update;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Application\Operation\Article\Write\Update\ArticleWasUpdated;
use Mono\Component\Article\Domain\Operation\Article\Update\Factory\BuilderInterface;
use Mono\Component\Article\Domain\Operation\Article\Update\UpdaterInterface;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use Mono\Component\Article\Domain\Operation\Article\Update\Exception\UnableToUpdateException;
use App\CMS\Domain\Space\Operation\View\Model\SpaceInterface;
use App\CMS\Domain\Space\Operation\View\ViewerInterface as SpaceViewer;
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
        $article = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'content' => $command->getContent(),
            'categories' => $command->getCategories(),
            'spaces' => $command->getSpaces(),
        ]);

        try {
            $this->updater->update($article);
        } catch (UnableToUpdateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasUpdated($command->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
