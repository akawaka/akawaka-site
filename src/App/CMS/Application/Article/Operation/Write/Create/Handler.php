<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Write\Create;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Application\Operation\Article\Write\Create\ArticleWasCreated;
use Mono\Component\Article\Domain\Operation\Article\Create\CreatorInterface;
use Mono\Component\Article\Domain\Operation\Article\Create\Exception\UnableToCreateException;
use Mono\Component\Article\Domain\Operation\Article\Create\Factory\BuilderInterface;
use App\CMS\Domain\Space\Common\Identifier\SpaceId;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BuilderInterface $builder,
        private CreatorInterface $creator,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): bool
    {
        $article = $this->builder::build([
            'id' => $command->getId(),
            'slug' => $command->getSlug(),
            'name' => $command->getName(),
            'categories' => $command->getCategories(),
            'spaces' => $command->getSpaces(),
        ]);

        try {
            $this->creator->create($article);
        } catch (UnableToCreateException $exception) {
            return false;
        }

        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasCreated($article->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return true;
    }
}
