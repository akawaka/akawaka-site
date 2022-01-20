<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Space as BaseSpace;

#[ORM\Entity, ORM\Table(name: 'ao_space')]
class Space extends BaseSpace
{
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $theme;
}
