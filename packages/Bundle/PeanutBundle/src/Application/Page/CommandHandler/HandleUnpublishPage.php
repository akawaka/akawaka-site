<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\CommandHandler;

use Black\Bundle\PeanutBundle\Application\Page\Command\CommandUnpublishPage;
use Black\Bundle\PeanutBundle\Application\Page\Event\PageWasUnpublished;
use Black\Bundle\PeanutBundle\Domain\Repository\UnpublishPageRepository;
use Black\Bundle\PeanutBundle\Infrastructure\Slugger\SluggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class HandleUnpublishPage implements MessageHandlerInterface
{
    private UnpublishPageRepository $repository;

    private MessageBusInterface $eventBus;

    public function __construct(
        SluggerInterface $slugger,
        UnpublishPageRepository $repository,
        MessageBusInterface $eventBus
    ) {
        $this->slugger = $slugger;
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CommandUnpublishPage $command): void
    {
        $page = $command->getPage();
        $page->unpublish();

        $this->repository->save($page);
        $this->eventBus->dispatch(new PageWasUnpublished($page));
    }
}
