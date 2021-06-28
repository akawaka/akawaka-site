<?php

declare(strict_types=1);

namespace App\CMS\Application\Space\Operation\Read\FindAll;

use Mono\Component\Space\Domain\Operation\View\ViewerInterface;
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
