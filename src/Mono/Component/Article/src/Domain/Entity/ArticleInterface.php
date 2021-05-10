<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Entity;

use Doctrine\Common\Collections\Collection;
use Mono\Component\Article\Domain\Identifier\ArticleId;
use Mono\Component\Article\Domain\ValueObject\Slug;

interface ArticleInterface
{
    public function getId(): ArticleId;

    public function getName(): string;

    public function getSlug(): Slug;

    public function getContent(): ?string;

    public function getStatus(): string;

    public function getCategories(): Collection;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getLastUpdate(): ?\Safe\DateTimeImmutable;
}
