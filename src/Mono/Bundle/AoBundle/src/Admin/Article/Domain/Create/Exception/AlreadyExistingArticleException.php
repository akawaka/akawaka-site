<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Create\Exception;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

final class AlreadyExistingArticleException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s already exist', $id->getValue())
        );
    }
}
