<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Operation\Read\FindBySlug;

use Mono\Bundle\AoBundle\Admin\Article\Domain\View\DataProvider\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): ArticleInterface
    {
        return $this->viewer->readBySlug($query->getSlug());
    }
}
