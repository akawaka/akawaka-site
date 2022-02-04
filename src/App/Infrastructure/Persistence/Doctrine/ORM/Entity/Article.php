<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Article as BaseArticle;

#[ORM\Entity, ORM\Table(name: 'ao_article')]
class Article extends BaseArticle
{
}
