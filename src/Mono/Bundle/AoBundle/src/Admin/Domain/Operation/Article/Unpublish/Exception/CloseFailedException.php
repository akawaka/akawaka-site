<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Unpublish\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

final class CloseFailedException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during close process', $id->getValue())
        );
    }
}
