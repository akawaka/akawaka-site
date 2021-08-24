<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Publish\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

final class PublishFailedException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during publish process', $id->getValue())
        );
    }
}
