<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Domain\View\Exception;

final class UnknownAuthorException extends \Exception
{
    public function __construct($identifier)
    {
        parent::__construct(
            \Safe\sprintf('Author with identifier %s is unknown', $identifier)
        );
    }
}
