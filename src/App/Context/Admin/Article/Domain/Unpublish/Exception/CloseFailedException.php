<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Unpublish\Exception;

use App\Shared\Domain\Identifier\ArticleId;

final class CloseFailedException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during close process', $id->getValue())
        );
    }
}
