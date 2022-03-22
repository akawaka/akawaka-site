<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use App\Context\Admin\Article\Domain\Create\DataPersister\CreatePersisterInterface;
use App\Context\Admin\Article\Domain\Create\DataPersister\Model\ArticleInterface;
use App\Context\Admin\Article\Domain\Create\Exception\AlreadyExistingArticleException;
use App\Context\Admin\Article\Domain\Create\Exception\UnableToCreateException;

final class Creator implements CreatorInterface
{
    public function __construct(
        private CreatePersisterInterface $persister
    ) {
    }

    public function create(ArticleInterface $article): void
    {
        try {
            $this->persister->create($article);
        } catch (UniqueConstraintViolationException $exception) {
            throw new AlreadyExistingArticleException($article->getId());
        } catch (\Exception $exception) {
            throw new UnableToCreateException();
        }
    }
}
