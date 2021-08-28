<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Delete\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during delete process', $id->getValue())
        );
    }
}
