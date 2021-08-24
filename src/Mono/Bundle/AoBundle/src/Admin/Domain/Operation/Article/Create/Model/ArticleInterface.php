<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Create\Model;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;
use Mono\Bundle\AoBundle\Admin\Domain\Shared\ValueObject\Slug;

interface ArticleInterface
{
    public function getId(): ArticleId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getAuthors(): array;

    public function getCategories(): array;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
