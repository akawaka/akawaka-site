<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Application\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

final class Query
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): ArticleId
    {
        return new ArticleId($this->id);
    }
}
