<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Create\Exception;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\ArticleId;

final class AlreadyExistingArticleException extends \Exception
{
    public function __construct(ArticleId $id)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s already exist', $id->getValue())
        );
    }
}
