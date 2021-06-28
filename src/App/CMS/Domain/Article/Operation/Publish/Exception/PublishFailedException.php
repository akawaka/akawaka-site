<?php

declare(strict_types=1);

namespace App\CMS\Domain\Article\Operation\Publish\Exception;

use Mono\Component\Article\Domain\Common\Identifier\ArticleId;

final class PublishFailedException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article %s failed during publish process', $id->getValue())
        );
    }
}
