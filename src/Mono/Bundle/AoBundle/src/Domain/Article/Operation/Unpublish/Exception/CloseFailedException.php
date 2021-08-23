<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Domain\Article\Operation\Unpublish\Exception;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class CloseFailedException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during close process', $id->getValue())
        );
    }
}
