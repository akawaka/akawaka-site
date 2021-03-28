<?php

declare(strict_types=1);

namespace App\Cms\Application\Operation\Write\CreatePage;

use App\Cms\Domain\Entity\Page;
use Black\Component\Page\Domain\Entity\PageInterface;
use Black\Component\Page\Domain\Repository\Create;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    private Create $repository;

    private MessageBusInterface $bus;

    public function __construct(
        Create $repository,
        MessageBusInterface $eventBus
    ) {
        $this->repository = $repository;
        $this->bus = $eventBus;
    }

    public function __invoke(Command $command): PageInterface
    {
        $page = Page::create(
            $this->repository->nextIdentity(),
            $command->getSlug(),
            $command->getName(),
            $command->getChannel(),
        );

        $this->repository->insert($page);
        $this->bus->dispatch(new Event($page));

        return $page;
    }
}
