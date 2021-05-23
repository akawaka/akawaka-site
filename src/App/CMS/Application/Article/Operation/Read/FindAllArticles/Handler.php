<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Read\FindAllArticles;

use Mono\Component\Article\Domain\Repository\FindAllArticles;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private FindAllArticles $reader,
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->reader->findAll();
    }
}
