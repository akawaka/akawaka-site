<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity;

use App\Shared\Domain\Model\ArticleInterface;
use App\Shared\Domain\Model\AuthorInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'ao_author')]
class Author implements AuthorInterface
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'NONE'), ORM\Column(type: Types::GUID)]
    protected string $id;

    #[ORM\Column(type: Types::STRING, unique: true)]
    protected string $name;

    #[ORM\Column(type: Types::STRING)]
    protected string $slug;

    #[ORM\ManyToMany(targetEntity: ArticleInterface::class, mappedBy: 'authors')]
    protected Collection $articles;
}
