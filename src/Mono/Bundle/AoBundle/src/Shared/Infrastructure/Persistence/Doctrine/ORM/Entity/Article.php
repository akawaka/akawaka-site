<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AoBundle\Shared\Domain\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Model\SpaceInterface;

#[ORM\MappedSuperclass, ORM\Table(name: 'ao_article')]
class Article implements ArticleInterface
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

    #[ORM\ManyToMany(targetEntity: CategoryInterface::class, inversedBy: 'articles')]
    #[ORM\JoinTable(name: 'ao_article_categories')]
    #[ORM\JoinColumn(name: 'article_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'category_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected Collection $categories;

    #[ORM\ManyToMany(targetEntity: AuthorInterface::class, inversedBy: 'articles')]
    #[ORM\JoinTable(name: 'ao_article_authors')]
    #[ORM\JoinColumn(name: 'article_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'author_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected Collection $authors;

    #[ORM\ManyToMany(targetEntity: SpaceInterface::class)]
    #[ORM\JoinTable(name: 'ao_article_spaces')]
    #[ORM\JoinColumn(name: 'article_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'space_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected Collection $spaces;
}
