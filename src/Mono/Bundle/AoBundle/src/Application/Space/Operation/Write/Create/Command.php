<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Space\Operation\Write\Create;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Bundle\AoBundle\Domain\Space\Common\ValueObject\SpaceCode;

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

    public function getCode(): SpaceCode
    {
        return new SpaceCode($this->code);
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
