<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Delete\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

final class UnableToDeleteException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during delete process', $id->getValue())
        );
    }
}
