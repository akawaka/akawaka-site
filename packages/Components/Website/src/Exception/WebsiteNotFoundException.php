<?php

declare(strict_types=1);

namespace Black\Component\Website\Exception;

final class WebsiteNotFoundException extends \Exception
{
    public function __construct(string $identifier)
    {
        parent::__construct(
            \Safe\sprintf('Website with identifier %s is unknown', $identifier)
        );
    }
}
