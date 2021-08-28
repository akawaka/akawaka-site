<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Exception\UnableToCreateException;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Exception\AlreadyExistingArticleException;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Repository\WriterInterface;

final class Creator implements CreatorInterface
{
    public function __construct(
        private WriterInterface $writer
    ) {
    }

    public function create(ArticleInterface $article): void
    {
        try {
            $this->writer->create($article);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingArticleException($article->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException();
        }
    }
}
