<?php

declare(strict_types=1);

namespace Mono\Component\Page\Infrastructure\Persistence\ORM\Mapping;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
class Page implements PageInterface
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'NONE'), ORM\Column(type: Types::GUID)]
    protected string $id;

    #[ORM\Column(type: Types::STRING, unique: true)]
    protected string $name;

    #[ORM\Column(type: Types::STRING)]
    protected string $slug;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $content;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected \DateTimeImmutable $creationDate;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    protected ?\DateTimeImmutable $lastUpdate;
}
