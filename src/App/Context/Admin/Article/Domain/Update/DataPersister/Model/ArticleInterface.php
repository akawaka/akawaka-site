<?php

declare(strict_types=1);

namespace App\Context\Admin\Article\Domain\Update\DataPersister\Model;

use App\Shared\Domain\Identifier\ArticleId;

interface ArticleInterface
{
    public function getId(): ArticleId;
}
