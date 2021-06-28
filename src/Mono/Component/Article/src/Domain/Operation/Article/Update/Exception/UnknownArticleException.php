<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Update\Exception;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class UnknownArticleException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s is unknown', $id->getValue())
        );
    }
}