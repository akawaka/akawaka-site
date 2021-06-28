<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Write\UpdateArticle;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\Repository\FindArticleById;
use Mono\Component\Article\Domain\Repository\FindCategoryById;
use Mono\Component\Article\Domain\Repository\UpdateArticle;
use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Operation\View\ViewerInterface as SpaceViewer;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindArticleById $reader,
        private FindCategoryById $categoryReader,
        private SpaceViewer $spaceReader,
        private UpdateArticle $writer,
        private MessageBusInterface $eventBus
    ) {
    }

    public function __invoke(Command $command): ArticleInterface
    {
        $article = $this->reader->find($command->getArticleId());

        $spaces = new ArrayCollection();
        foreach ($command->getSpaces() as $space) {
            $spaces->add($this->spaceReader->read(new SpaceId($space)));
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
            $spaces,
        );

        $this->writer->update($article);
        $this->eventBus->dispatch(
            (new Envelope(new ArticleWasUpdated($article->getId()->getValue())))
                ->with(new DispatchAfterCurrentBusStamp())
        );

        return $article;
    }
}
