<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Browse\DataProvider\Model;

use App\Shared\Domain\Identifier\AuthorId;
use App\Shared\Domain\ValueObject\Slug;

interface AuthorInterface
{
    public function getId(): AuthorId;

    public function getSlug(): Slug;

    public function getName(): string;
}
