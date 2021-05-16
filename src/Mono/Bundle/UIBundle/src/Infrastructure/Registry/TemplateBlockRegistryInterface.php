<?php

declare(strict_types=1);

namespace Mono\Bundle\UIBundle\Infrastructure\Registry;

interface TemplateBlockRegistryInterface
{
    public function all(): array;

    public function findEnabledForEvents(array $eventNames): array;
}
