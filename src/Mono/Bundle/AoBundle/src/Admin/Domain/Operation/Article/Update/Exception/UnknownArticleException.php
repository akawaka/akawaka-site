<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Update\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

final class UnknownArticleException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s is unknown', $id->getValue())
        );
    }
}
