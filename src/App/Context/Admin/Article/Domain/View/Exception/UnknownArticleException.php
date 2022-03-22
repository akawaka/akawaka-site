<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\View\Exception;

final class UnknownArticleException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Article with identifier %s is unknown', $identifier)
        );
    }
}
