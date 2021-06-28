<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Create\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mono\Component\Article\Domain\Common\Identifier\ArticleId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

interface ArticleInterface
{
    public function getId(): ArticleId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getCategories(): array;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
