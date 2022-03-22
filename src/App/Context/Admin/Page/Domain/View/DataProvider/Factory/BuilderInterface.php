<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\View\DataProvider\Factory;

use App\Context\Admin\Page\Domain\View\DataProvider\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
