<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Application\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;

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
