<?php

declare(strict_types=1);

namespace App\CMS\Application\Operation\Write\CreateArticle;

use App\CMS\Domain\Entity\Article;
use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\Repository\CreateArticle;
use Mono\Component\Article\Domain\Repository\FindCategoryById;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\Repository\FindChannelById;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindCategoryById $categoryReader,
        private FindChannelById $channelReader,
        private CreateArticle $repository,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ArticleInterface
    {
        $channels = new ArrayCollection();
        foreach ($command->getChannels() as $channel) {
            $channels->add($this->channelReader->find(new ChannelId($channel)));
        }

        $categories = new ArrayCollection();
        foreach ($command->getCategories() as $category) {
            $categories->add($this->categoryReader->find(new CategoryId($category)));
        }

        $article = Article::create(
            $this->repository->nextIdentity(),
            $command->getSlug(),
            $command->getName(),
            $categories,
            $channels,
        );

        $this->repository->insert($article);
        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasCreated($article->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $article;
    }
}