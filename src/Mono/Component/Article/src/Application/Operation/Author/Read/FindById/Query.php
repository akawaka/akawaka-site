<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Author\Read\FindById;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;

final class Query
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): AuthorId
    {
        return new AuthorId($this->id);
    }
}
