<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Article\Domain\Update\DataPersister\Model;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\ArticleId;

interface ArticleInterface
{
    public function getId(): ArticleId;
}
