<?php

declare(strict_types=1);

namespace Mono\Component\Page\Domain\Exception;

final class PageNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Page with identifier %s is unknown', $identifier)
        );
    }
}
