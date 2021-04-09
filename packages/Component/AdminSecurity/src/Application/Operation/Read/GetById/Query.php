<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Read\GetById;

use Mono\Component\AdminSecurity\Domain\Identifier\UserId;

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
