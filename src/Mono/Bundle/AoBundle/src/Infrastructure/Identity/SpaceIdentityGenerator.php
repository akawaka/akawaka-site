<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Infrastructure\Identity;

use Mono\Bundle\AoBundle\Domain\Space\Common\Identifier\SpaceId;
use Mono\Component\Core\Infrastructure\Generator\GeneratorInterface;

final class SpaceIdentityGenerator
{
    public function __construct(
        private GeneratorInterface $generator,
    ) {
    }

    public function nextIdentity(): SpaceId
    {
        return new SpaceId($this->generator::generate());
    }
}
