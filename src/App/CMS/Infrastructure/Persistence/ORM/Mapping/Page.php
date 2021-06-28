<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Mapping;

use Doctrine\Common\Collections\Collection;
use Mono\Component\Page\Infrastructure\Persistence\ORM\Mapping\Page as BasePage;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity, ORM\Table(schema: 'cms_page')]
class Page extends BasePage
{
    #[ORM\Column(type: Types::STRING)]
    protected string $status;

    #[ORM\ManyToMany(targetEntity: SpaceInterface::class)]
    #[ORM\JoinTable(name: 'cms_page_spaces')]
    #[ORM\JoinColumn(name: 'page_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'space_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected Collection $spaces;
}
