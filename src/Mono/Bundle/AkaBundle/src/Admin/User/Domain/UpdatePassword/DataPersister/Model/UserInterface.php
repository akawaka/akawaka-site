<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\DataPersister\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

interface UserInterface
{
    public function getId(): UserId;

    public function getPassword(): string;
}
