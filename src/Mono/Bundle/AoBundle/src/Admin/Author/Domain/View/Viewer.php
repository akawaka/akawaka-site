<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\View;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\AuthorId;
use Mono\Bundle\AoBundle\Shared\Domain\ValueObject\Slug;
use Mono\Bundle\AoBundle\Admin\Author\Domain\View\Exception\UnknownAuthorException;
use Mono\Bundle\AoBundle\Admin\Author\Domain\View\Factory\BuilderInterface;
use Mono\Bundle\AoBundle\Admin\Author\Domain\View\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Admin\Author\Domain\View\Repository\ReaderInterface;

final class Viewer implements ViewerInterface
{
    public function __construct(
        private ReaderInterface $reader,
        private BuilderInterface $builder,
    ) {
    }

    public function read(AuthorId $id): AuthorInterface
    {
        $result = $this->reader->get($id);

        if ([] === $result) {
            throw new UnknownAuthorException($id->getValue());
        }

        return $this->builder::build($result);
    }

    public function readBySlug(Slug $slug): ?AuthorInterface
    {
        $result = $this->reader->getBySlug($slug);

        if ([] === $result) {
            throw new UnknownAuthorException($slug->getValue());
        }

        return $this->builder::build($result);
    }

    public function readAll(): array
    {
        $collection = [];
        $results = $this->reader->getAll();

        foreach ($results as $result) {
            $collection[] = $this->builder::build($result);
        }

        return $collection;
    }
}
