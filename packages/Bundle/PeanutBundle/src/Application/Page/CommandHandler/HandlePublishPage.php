<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\CommandHandler;

use Black\Bundle\PeanutBundle\Application\Page\Command\CommandPublishPage;
use Black\Bundle\PeanutBundle\Application\Page\Event\PageWasPublished;
use Black\Bundle\PeanutBundle\Domain\Repository\PublishPageRepository;
use Black\Bundle\PeanutBundle\Infrastructure\Slugger\SluggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class HandlePublishPage implements MessageHandlerInterface
{
    private PublishPageRepository $repository;

    private MessageBusInterface $eventBus;

    public function __construct(
        SluggerInterface $slugger,
        PublishPageRepository $repository,
        MessageBusInterface $eventBus
    ) {
        $this->slugger = $slugger;
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CommandPublishPage $command): void
    {
        $page = $command->getPage();
        $page->publish();

        $this->repository->save($page);
        $this->eventBus->dispatch(new PageWasPublished($page));
    }
}
