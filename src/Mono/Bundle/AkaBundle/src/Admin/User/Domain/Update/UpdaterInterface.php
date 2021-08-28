<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Update;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Model\UserInterface;

interface UpdaterInterface
{
    public function update(UserInterface $User): void;
}
