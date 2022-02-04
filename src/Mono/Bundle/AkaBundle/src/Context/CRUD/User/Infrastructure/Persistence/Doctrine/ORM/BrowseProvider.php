<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Infrastructure\Persistence\Doctrine\ORM;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\BrowseProviderInterface;
use Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\AdminUserRepository;

final class BrowseProvider implements BrowseProviderInterface
{
    public function __construct(
        private AdminUserRepository $repository,
    ) {
    }

    public function browse(): array
    {
        return $this->repository->findAll();
    }
}
