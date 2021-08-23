<?php

declare(strict_types=1);

namespace Mono\Component\Article\Domain\Operation\Author\Create\Exception;

final class UnableToCreateException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            \Safe\sprintf('Author was not created')
        );
    }
}
