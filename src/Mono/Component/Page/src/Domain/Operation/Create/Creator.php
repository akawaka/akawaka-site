<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Operation\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Component\Page\Domain\Operation\Create\Exception\UnableToCreateException;
use Mono\Component\Page\Domain\Operation\Create\Exception\AlreadyExistingPageException;
use Mono\Component\Page\Domain\Operation\Create\Model\PageInterface;
use Mono\Component\Page\Domain\Operation\Create\Repository\WriterInterface;

final class Creator implements CreatorInterface
{
    public function __construct(
        private WriterInterface $writer
    ) {
    }

    public function create(PageInterface $page): void
    {
        try {
            $this->writer->create($page);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingPageException($page->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException($exception->getMessage());
        }
    }
}
