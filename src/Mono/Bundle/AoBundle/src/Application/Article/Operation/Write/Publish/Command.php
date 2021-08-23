<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Article\Operation\Write\Publish;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): ArticleId
    {
        return new ArticleId($this->identifier);
    }
}
