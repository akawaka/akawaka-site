<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\Delete\Exception;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during delete process', $id->getValue())
        );
    }
}
