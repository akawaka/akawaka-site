<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\CommandHandler;

use Black\Bundle\PeanutBundle\Application\Page\Command\CommandCreatePage;
use Black\Bundle\PeanutBundle\Application\Page\Event\PageWasCreated;
use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Repository\CreatePageRepository;
use Black\Bundle\PeanutBundle\Infrastructure\Slugger\SluggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class HandleCreatePage implements MessageHandlerInterface
{
    private SluggerInterface $slugger;

    private CreatePageRepository $repository;

    private MessageBusInterface $eventBus;

    public function __construct(
        SluggerInterface $slugger,
        CreatePageRepository $repository,
        MessageBusInterface $eventBus
    ) {
        $this->slugger = $slugger;
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CommandCreatePage $command): void
    {
        $page = Page::create(
            $command->getId(),
            $this->slugger->slugify($command->getSlug()),
            $command->getName(),
            $command->getContent()
        );

        $this->repository->save($page);
        $this->eventBus->dispatch(new PageWasCreated($page));
    }
}
