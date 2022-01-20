<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Application\Operation\Read\FindById;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class Query
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): UserId
    {
        return new UserId($this->id);
    }
}
