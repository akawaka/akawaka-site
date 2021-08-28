<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Repository;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Model\UserInterface;

interface WriterInterface
{
    public function update(UserInterface $User): bool;
}
