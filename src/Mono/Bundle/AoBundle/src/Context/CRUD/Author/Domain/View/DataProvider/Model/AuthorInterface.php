<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\View\DataProvider\Model;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

interface AuthorInterface
{
    public function getId(): AuthorId;

    public function getSlug(): Slug;

    public function getName(): string;
}
