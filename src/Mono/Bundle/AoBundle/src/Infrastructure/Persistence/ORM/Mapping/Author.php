<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(name: 'cms_author')]
class Author implements AuthorInterface
{
    #[ORM\Id, ORM\GeneratedValue(strategy: 'NONE'), ORM\Column(type: Types::GUID)]
    protected string $id;

    #[ORM\Column(type: Types::STRING, unique: true)]
    protected string $name;

    #[ORM\Column(type: Types::STRING)]
    protected string $slug;

    #[ORM\ManyToMany(targetEntity: ArticleInterface::class, mappedBy: 'categories')]
    protected Collection $articles;
}
