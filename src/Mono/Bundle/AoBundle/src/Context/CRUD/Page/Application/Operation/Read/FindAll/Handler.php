<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Operation\Read\FindAll;

use Mono\Bundle\AoBundle\Context\CRUD\Page\Domain\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->viewer->readAll();
    }
}
