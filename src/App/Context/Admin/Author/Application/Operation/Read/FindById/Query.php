<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Operation\Read\FindById;

use App\Shared\Domain\Identifier\AuthorId;

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
