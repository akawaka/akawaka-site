<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Application\Operation\Read\FindBySlug;

use Mono\Bundle\AoBundle\Admin\Author\Domain\View\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Admin\Author\Domain\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): AuthorInterface
    {
        return $this->viewer->readBySlug($query->getSlug());
    }
}
