<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\UpdateArticle;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\Repository\FindArticleById;
use Mono\Component\Article\Domain\Repository\FindCategoryById;
use Mono\Component\Article\Domain\Repository\UpdateArticle;
use Mono\Component\Channel\Domain\Identifier\ChannelId;
use Mono\Component\Channel\Domain\Repository\FindChannelById;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindArticleById $reader,
        private FindCategoryById $categoryReader,
        private FindChannelById $channelReader,
        private UpdateArticle $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ArticleInterface
    {
        $article = $this->reader->find($command->getArticleId());

        $channels = new ArrayCollection();
        foreach ($command->getChannels() as $channel) {
            $channels->add($this->channelReader->find(new ChannelId($channel)));
        }

        $categories = new ArrayCollection();
        foreach ($command->getCategories() as $category) {
            $categories->add($this->categoryReader->find(new CategoryId($category)));
        }

        $article->update(
            $command->getName(),
            $command->getSlug(),
            $command->getContent(),
            $categories,
            $channels,
        );

        $this->writer->update($article);
        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasUpdated($article->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $article;
    }
}
