<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\View;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\View\DataProvider\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\View\DataProvider\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\View\DataProvider\ViewProviderInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\View\Exception\UnknownAuthorException;
use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;

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
