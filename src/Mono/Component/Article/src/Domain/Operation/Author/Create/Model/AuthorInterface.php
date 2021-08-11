<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Create\Model;

use Mono\Component\Article\Domain\Common\Identifier\AuthorId;
use Mono\Component\Article\Domain\Common\ValueObject\Slug;

interface AuthorInterface
{
    public function getId(): AuthorId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
