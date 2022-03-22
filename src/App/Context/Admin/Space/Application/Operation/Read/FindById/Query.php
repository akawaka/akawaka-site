<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Operation\Read\FindById;

use App\Shared\Domain\Identifier\SpaceId;

final class Query
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): SpaceId
    {
        return new SpaceId($this->id);
    }
}
