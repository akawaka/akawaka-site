<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\QueryHandler;

use Black\Bundle\PeanutBundle\Application\Page\Event\PageWasFound;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPageById;
use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Repository\FindPageByIdRepository;
use Black\Component\Page\Exception\PageNotFoundException;
use Symfony\Component\Messenger\MessageBusInterface;

final class HandleFindPageById
{
    private FindPageByIdRepository $repository;

    private MessageBusInterface $eventBus;

    public function __construct(
        FindPageByIdRepository $repository,
        MessageBusInterface $eventBus
    ) {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(QueryFindPageById $query): Page
    {
        $page = $this->repository->findPageById($query->getId());

        if (null === $page) {
            throw new PageNotFoundException($query->getId()->getValue());
        }

        $this->eventBus->dispatch(new PageWasFound($page));

        return $page;
    }
}
