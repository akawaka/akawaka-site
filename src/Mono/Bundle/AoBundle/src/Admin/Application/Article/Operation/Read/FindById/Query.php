<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Article\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

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
