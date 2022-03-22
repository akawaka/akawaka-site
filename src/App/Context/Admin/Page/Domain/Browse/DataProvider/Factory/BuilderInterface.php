<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Browse\DataProvider\Factory;

use App\Context\Admin\Page\Domain\Browse\DataProvider\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
