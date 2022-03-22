<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\View;

use App\Context\Admin\Author\Domain\View\DataProvider\Factory\BuilderInterface;
use App\Context\Admin\Author\Domain\View\DataProvider\Model\AuthorInterface;
use App\Context\Admin\Author\Domain\View\DataProvider\ViewProviderInterface;
use App\Context\Admin\Author\Domain\View\Exception\UnknownAuthorException;
use App\Shared\Domain\Identifier\AuthorId;
use App\Shared\Domain\ValueObject\Slug;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ViewProviderInterface $provider,
        private BuilderInterface $builder,
    ) {
    }

    public function read(AuthorId $id): AuthorInterface
    {
        $result = $this->provider->get($id);

        if ([] === $result) {
            throw new UnknownAuthorException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readBySlug(Slug $slug): ?AuthorInterface
    {
        $result = $this->provider->getBySlug($slug);

        if ([] === $result) {
            throw new UnknownAuthorException($slug->getValue());
        }

        return $this->builder::build($result);
    }
}
