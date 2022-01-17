<?php

declare(strict_types=1);

namespace App\Infrastructure\Theme\Space\Context\Request;

use Mono\Bundle\AoBundle\Admin\Space\Domain\View\DataProvider\Model\SpaceInterface;
use Symfony\Component\HttpFoundation\Request;

interface RequestSpaceContextInterface
{
    public function getSpace(Request $request): ?SpaceInterface;
}
