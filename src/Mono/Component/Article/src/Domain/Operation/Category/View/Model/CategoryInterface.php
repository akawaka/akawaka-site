<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\View\Model;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

interface CategoryInterface
{
    public function getId(): CategoryId;

    public function getSlug(): Slug;

    public function getName(): string;
}
