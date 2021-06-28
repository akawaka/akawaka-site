<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Article\View\Exception;

final class UnknownArticleException extends \Exception
{
    public function __construct($identifier)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s is unknown', $identifier)
        );
    }
}
