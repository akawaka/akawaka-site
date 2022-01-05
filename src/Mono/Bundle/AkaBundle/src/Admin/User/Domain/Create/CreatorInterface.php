<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Create;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister\Model\UserInterface;

interface CreatorInterface
{
    public function create(UserInterface $user): void;
}
