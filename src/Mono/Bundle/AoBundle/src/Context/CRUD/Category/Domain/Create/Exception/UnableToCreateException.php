<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Domain\Create\Exception;

final class UnableToCreateException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            \Safe\sprintf('Category was not created')
        );
    }
}
