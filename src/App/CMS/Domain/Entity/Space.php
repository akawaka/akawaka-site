<?php

declare(strict_types=1);

namespace App\CMS\Domain\Entity;

use Mono\Component\Space\Domain\Entity\Space as BaseSpace;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Space\Domain\Identifier\SpaceId;
use Mono\Component\Space\Domain\ValueObject\SpaceCode;

class Space extends BaseSpace
{
    protected ?string $theme;

    public function __construct()
    {
        parent::__construct();

        $this->theme = null;
    }

    public static function create(
        SpaceId $id,
        SpaceCode $code,
        string $name,
        ?string $theme,
    ): SpaceInterface {
        $space = new self();
        $space->id = $id->getValue();
        $space->code = $code->getValue();
        $space->name = $name;
        $space->theme = $theme;

        return $space;
    }

    public function updateTheme(
        ?string $theme
    ): void {
        $this->theme = $theme;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }
}
