<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Delete\Exception;

use App\Shared\Domain\Identifier\ArticleId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during delete process', $id->getValue())
        );
    }
}
