<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Page as BasePage;

#[ORM\Entity, ORM\Table(name: 'ao_page')]
class Page extends BasePage
{

}
