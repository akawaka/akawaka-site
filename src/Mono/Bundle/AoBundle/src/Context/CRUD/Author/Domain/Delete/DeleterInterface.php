<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;

interface DeleterInterface
{
    public function delete(AuthorId $id): void;
}
