<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Create\Exception;

use App\Shared\Domain\Identifier\ArticleId;

final class AlreadyExistingArticleException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s already exist', $id->getValue())
        );
    }
}
