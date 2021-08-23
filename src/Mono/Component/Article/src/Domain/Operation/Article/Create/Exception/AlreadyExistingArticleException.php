<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Create\Exception;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class AlreadyExistingArticleException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s already exist', $id->getValue())
        );
    }
}
