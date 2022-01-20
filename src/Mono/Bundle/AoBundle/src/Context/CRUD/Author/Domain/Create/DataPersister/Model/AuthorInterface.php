<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\Create\DataPersister\Model;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface AuthorInterface
{
    public function getId(): AuthorId;

    public function getSlug(): Slug;

    public function getName(): string;

    public function getCreationDate(): \Safe\DateTimeImmutable;
}
