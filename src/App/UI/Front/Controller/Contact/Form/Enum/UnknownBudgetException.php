<?php

declare(strict_types=1);

namespace App\UI\Front\Controller\Contact\Form\Enum;

final class UnknownBudgetException extends \Exception
{
    public function __construct(string $budget)
    {
        parent::__construct(
            \Safe\sprintf('Budget %s is unknown', $budget)
        );
    }
}
