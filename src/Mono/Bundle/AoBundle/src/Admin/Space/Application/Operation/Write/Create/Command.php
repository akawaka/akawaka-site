<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Space\Application\Operation\Write\Create;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Code;

final class Command
{
    public function __construct(
        private SpaceId $id,
        private string $code,
        private string $name,
    ) {
    }

    public function getId(): SpaceId
    {
        return $this->id;
    }

    public function getCode(): Code
    {
        return new Code($this->code);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
