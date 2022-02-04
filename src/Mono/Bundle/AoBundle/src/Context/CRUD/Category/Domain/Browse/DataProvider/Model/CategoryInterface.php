<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Browse\DataProvider\Model;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface CategoryInterface
{
    public function getId(): CategoryId;

    public function getSlug(): Slug;

    public function getName(): string;
}
