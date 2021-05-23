<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Operation\Write\Create;

use App\CMS\Domain\Entity\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Space\Domain\Identifier\SpaceId;
use Mono\Component\Space\Domain\Repository\FindSpaceById;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository\CreatePage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindSpaceById $spaceReader,
        private CreatePage $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): PageInterface
    {
        $spaces = new ArrayCollection();
        foreach ($command->getSpaces() as $space) {
            $spaces->add($this->spaceReader->find(new SpaceId($space)));
        }

        $page = Page::create(
            $this->repository->nextIdentity(),
            $command->getSlug(),
            $command->getName(),
            $spaces,
        );

        $this->repository->insert($page);
        $this->eventBus->dispatch(
            (new Envelope(new PageWasCreated($page->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $page;
    }
}
