<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Category\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Component\Article\Domain\Operation\Category\Create\Exception\UnableToCreateException;
use Mono\Component\Article\Domain\Operation\Category\Create\Exception\AlreadyExistingCategoryException;
use Mono\Component\Article\Domain\Operation\Category\Create\Model\CategoryInterface;
use Mono\Component\Article\Domain\Operation\Category\Create\Repository\WriterInterface;

final class Creator implements CreatorInterface
{
    public function __construct(
        private WriterInterface $writer
    ) {
    }

    public function create(CategoryInterface $category): void
    {
        try {
            $this->writer->create($category);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingCategoryException($category->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException();
        }
    }
}
