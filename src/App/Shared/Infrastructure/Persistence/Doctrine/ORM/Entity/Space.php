<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity;

use App\Shared\Domain\Model\SpaceInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'ao_space')]
class Space implements SpaceInterface
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'NONE'), ORM\Column(type: Types::GUID)]
    protected string $id;

    #[ORM\Column(type: Types::STRING, unique: true)]
    protected string $code;

    #[ORM\Column(type: Types::STRING)]
    protected string $name;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $url;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $description;

    #[ORM\Column(type: Types::STRING)]
    protected string $status;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected \DateTimeImmutable $creationDate;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    protected ?\DateTimeImmutable $lastUpdate;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $theme;
}
