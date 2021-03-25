<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\QueryHandler;

use Black\Bundle\PeanutBundle\Application\Page\Event\PageWasFound;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPageBySlug;
use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Repository\FindPageBySlugRepository;
use Black\Component\Page\Exception\PageNotFoundException;
use Symfony\Component\Messenger\MessageBusInterface;

final class HandleFindPageBySlug
{
    private FindPageBySlugRepository $repository;

    private MessageBusInterface $eventBus;

    public function __construct(
        FindPageBySlugRepository $repository,
        MessageBusInterface $eventBus
    ) {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(QueryFindPageBySlug $query): Page
    {
        $page = $this->repository->findPageBySlug($query->getSlug());

        if (null === $page) {
            throw new PageNotFoundException($query->getSlug());
        }

        $this->eventBus->dispatch(new PageWasFound($page));

        return $page;
    }
}
