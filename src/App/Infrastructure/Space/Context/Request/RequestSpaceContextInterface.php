<?php

declare(strict_types=1);

namespace App\Infrastructure\Space\Context\Request;

use App\CMS\Domain\Space\Operation\View\Model\SpaceInterface;
use Symfony\Component\HttpFoundation\Request;

interface RequestSpaceContextInterface
{
    public function getSpace(Request $request): ?SpaceInterface;
}
