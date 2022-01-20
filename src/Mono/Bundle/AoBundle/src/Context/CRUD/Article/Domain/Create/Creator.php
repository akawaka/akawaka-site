<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create\DataPersister\CreatePersisterInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create\DataPersister\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create\Exception\AlreadyExistingArticleException;
use Mono\Bundle\AoBundle\Context\CRUD\Article\Domain\Create\Exception\UnableToCreateException;

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
