<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Component\Article\Domain\Operation\Article\Create\Exception\UnableToCreateException;
use Mono\Component\Article\Domain\Operation\Article\Create\Exception\AlreadyExistingArticleException;
use Mono\Component\Article\Domain\Operation\Article\Create\Model\ArticleInterface;
use Mono\Component\Article\Domain\Operation\Article\Create\Repository\WriterInterface;

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
