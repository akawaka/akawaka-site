<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Mapping;

use Doctrine\Common\Collections\Collection;
use Mono\Component\Article\Infrastructure\Persistence\ORM\Mapping\Article as BaseArticle;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(schema: 'cms_article')]
class Article extends BaseArticle
{
    #[ORM\Column(type: Types::STRING)]
    protected string $status;

    #[ORM\ManyToMany(targetEntity: SpaceInterface::class)]
    #[ORM\JoinTable(name: 'cms_article_spaces')]
    #[ORM\JoinColumn(name: 'article_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'space_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected Collection $spaces;
}
