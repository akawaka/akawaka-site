<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Infrastructure\Persistence\Doctrine\ORM;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;

final class ViewProvider implements ViewProviderInterface
{
    public function __construct(
        private AdminUserRepository $repository,
    ) {
    }

    public function get(UserId $id): UserInterface
    {
        return $this->repository->find($id);
    }
}
