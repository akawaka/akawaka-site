<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Operation\Read\FindById;

use App\Context\Admin\Author\Domain\View\DataProvider\Model\AuthorInterface;
use App\Context\Admin\Author\Domain\View\ViewerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private ViewerInterface $viewer
    ) {
    }

    public function __invoke(Query $query): AuthorInterface
    {
        return $this->viewer->read($query->getId());
    }
}
