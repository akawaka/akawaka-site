<?php

declare(strict_types=1);

namespace Black\Component\Page\Exception;

final class PageNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s is unknown', $identifier)
        );
    }
}
