<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Exception\AlreadyExistingCategoryException;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Admin\Category\Domain\Create\Repository\WriterInterface;

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
