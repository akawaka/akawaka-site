<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AoBundle\Shared\Domain\Model\PageInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Model\SpaceInterface;

#[ORM\Entity, ORM\Table(name: 'ao_page')]
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

    #[ORM\Column(type: Types::STRING)]
    protected string $status;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    protected \DateTimeImmutable $creationDate;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    protected ?\DateTimeImmutable $lastUpdate;

    #[ORM\ManyToMany(targetEntity: SpaceInterface::class)]
    #[ORM\JoinTable(name: 'ao_page_spaces')]
    #[ORM\JoinColumn(name: 'page_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'space_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected Collection $spaces;
}
