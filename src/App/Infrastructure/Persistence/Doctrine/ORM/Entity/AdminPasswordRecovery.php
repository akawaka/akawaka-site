<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\ORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\AdminPasswordRecovery as BaseAdminPasswordRecovery;

#[ORM\Entity, ORM\Table(name: 'security_admin_recovery')]
class AdminPasswordRecovery extends BaseAdminPasswordRecovery
{
}
