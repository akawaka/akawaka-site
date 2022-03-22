<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Domain\Create\DataPersister\Factory;

use App\Context\Admin\Page\Domain\Create\DataPersister\Model\PageInterface;

interface BuilderInterface
{
    public static function build(array $page = []): PageInterface;
}
