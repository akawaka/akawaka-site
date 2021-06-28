<?php

declare(strict_types=1);

namespace Mono\Component\Space\Domain\Operation\Update;

use Mono\Component\Space\Domain\Common\Identifier\SpaceId;
use Mono\Component\Space\Domain\Operation\Update\Model\SpaceInterface;

interface WriterInterface
{
    public function update(SpaceId $id,
                           string $name,
                           ?string $url,
                           ?string $description): bool;
}
