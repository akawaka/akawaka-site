<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Space\Operation\Write\Create;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Code;

final class Command
{
    public function __construct(
        private SpaceId $id,
        private string $code,
        private string $name,
        private ?string $theme,
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

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
