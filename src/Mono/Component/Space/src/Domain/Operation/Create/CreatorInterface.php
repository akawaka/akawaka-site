<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Create;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Operation\Create\Model\SpaceInterface;

interface CreatorInterface
{
    public function create(SpaceInterface $space): void;

    public function nextIdentity(): SpaceId;
}
