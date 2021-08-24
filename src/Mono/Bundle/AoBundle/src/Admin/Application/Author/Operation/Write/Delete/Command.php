<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Operation\Write\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): AuthorId
    {
        return new AuthorId($this->identifier);
    }
}
