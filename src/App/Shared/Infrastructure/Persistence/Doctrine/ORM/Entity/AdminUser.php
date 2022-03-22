<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\AdminUser as BaseAdminUser;

#[ORM\Entity, ORM\Table(name: 'user_admin')]
class AdminUser extends BaseAdminUser
{
}
