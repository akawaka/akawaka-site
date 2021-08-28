<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Repository;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Model\UserInterface;

interface WriterInterface
{
    public function create(UserInterface $User): bool;
}
