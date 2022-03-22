<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Publish\Exception;

use App\Shared\Domain\Identifier\ArticleId;

final class PublishFailedException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during publish process', $id->getValue())
        );
    }
}
