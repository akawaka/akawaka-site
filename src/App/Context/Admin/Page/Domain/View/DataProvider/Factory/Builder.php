<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\View\DataProvider\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use App\Context\Admin\Page\Domain\View\DataProvider\Model\Page;
use App\Context\Admin\Page\Domain\View\DataProvider\Model\PageInterface;
use App\Shared\Domain\Identifier\PageId;
use App\Shared\Domain\ValueObject\Slug;

final class Builder implements BuilderInterface
{
    public static function build(array $page = []): PageInterface
    {
        return new Page(
            new PageId($page['id']),
            new Slug($page['slug']),
            $page['name'],
            $page['status'],
            new ArrayCollection($page['spaces']),
            \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $page['creation_date']),
            null !== $page['last_update'] ? \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $page['last_update']) : null,
            $page['content'],
        );
    }
}
