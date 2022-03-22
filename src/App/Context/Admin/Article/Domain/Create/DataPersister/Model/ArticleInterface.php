<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Create\DataPersister\Model;

use App\Shared\Domain\Identifier\ArticleId;
use App\Shared\Domain\ValueObject\Slug;

interface ArticleInterface
{
    public function getId(): ArticleId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getAuthors(): array;

    public function getCategories(): array;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getStatus(): string;

    public function getSpaces(): array;
}
