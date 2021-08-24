<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Article\Create\Exception;

final class UnableToCreateException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            \Safe\sprintf('Article was not created')
        );
    }
}
