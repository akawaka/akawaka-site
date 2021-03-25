<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\CommandHandler;

use Black\Bundle\PeanutBundle\Application\Page\Command\CommandUpdatePage;
use Black\Bundle\PeanutBundle\Application\Page\Event\PageWasUpdated;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPageById;
use Black\Bundle\PeanutBundle\Application\Page\QueryHandler\HandleFindPageById;
use Black\Bundle\PeanutBundle\Domain\Repository\UpdatePageRepository;
use Black\Bundle\PeanutBundle\Infrastructure\Slugger\SluggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class HandleUpdatePage implements MessageHandlerInterface
{
    private SluggerInterface $slugger;

    private HandleFindPageById $queryHandler;

    private UpdatePageRepository $repository;

    private MessageBusInterface $eventBus;

    public function __construct(
        SluggerInterface $slugger,
        HandleFindPageById $queryHandler,
        UpdatePageRepository $repository,
        MessageBusInterface $eventBus
    ) {
        $this->slugger = $slugger;
        $this->queryHandler = $queryHandler;
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CommandUpdatePage $command): void
    {
        $page = ($this->queryHandler)(new QueryFindPageById($command->getId()));

        $page->update(
            $command->getName(),
            $this->slugger->slugify($command->getSlug()),
            $command->getContent()
        );

        $this->repository->save($page);
        $this->eventBus->dispatch(new PageWasUpdated($page));
    }
}
