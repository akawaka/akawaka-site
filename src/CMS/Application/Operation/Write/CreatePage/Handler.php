<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreatePage;

use App\CMS\Domain\Entity\Page;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository\Create;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private Create $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): PageInterface
    {
        $page = Page::create(
            $this->repository->nextIdentity(),
            $command->getSlug(),
            $command->getName(),
            $command->getChannels(),
        );

        $this->repository->insert($page);
        $this->eventBus->dispatch(new PageWasCreated($page));

        return $page;
    }
}
