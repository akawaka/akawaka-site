<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Exception\AlreadyExistingPageException;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Model\PageInterface;
use Mono\Bundle\AoBundle\Admin\Domain\Operation\Page\Create\Repository\WriterInterface;

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
