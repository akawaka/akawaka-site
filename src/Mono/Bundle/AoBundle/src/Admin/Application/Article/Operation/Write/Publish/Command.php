<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Write\Publish;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

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
