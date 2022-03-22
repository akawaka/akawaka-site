<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\View\DataProvider\Model;

use Doctrine\Common\Collections\ArrayCollection;
use App\Shared\Domain\Identifier\ArticleId;
use App\Shared\Domain\ValueObject\Slug;

interface ArticleInterface
{
    public function getId(): ArticleId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getContent(): ?string;

    public function getCreationDate(): \Safe\DateTimeImmutable;

    public function getLastUpdate(): ?\Safe\DateTimeImmutable;

    public function getCategories(): ArrayCollection;

    public function getAuthors(): ArrayCollection;
}
