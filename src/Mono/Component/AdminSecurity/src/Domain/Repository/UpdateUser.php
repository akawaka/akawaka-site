<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain\Repository;

use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;

interface UpdateUser
{
    public function update(UserInterface $user): void;
}
