<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\AuthorId;

interface DeleterInterface
{
    public function delete(AuthorId $id): void;
}
