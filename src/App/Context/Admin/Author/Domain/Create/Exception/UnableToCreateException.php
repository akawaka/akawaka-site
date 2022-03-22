<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Domain\Create\Exception;

final class UnableToCreateException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            \Safe\sprintf('Author was not created')
        );
    }
}
