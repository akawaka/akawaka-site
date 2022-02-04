<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider;

interface BrowseProviderInterface
{
    public function browse(): array;
}
