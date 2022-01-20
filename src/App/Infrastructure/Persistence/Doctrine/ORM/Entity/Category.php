<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Category as BaseCategory;

#[ORM\Entity, ORM\Table(name: 'ao_category')]
class Category extends BaseCategory
{

}
