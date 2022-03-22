<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Update\Exception;

use App\Shared\Domain\Identifier\ArticleId;

final class UnknownArticleException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s is unknown', $id->getValue())
        );
    }
}
