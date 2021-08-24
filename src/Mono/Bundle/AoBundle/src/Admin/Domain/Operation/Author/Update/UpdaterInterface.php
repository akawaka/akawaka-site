<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Update;

use Mono\Bundle\AoBundle\Admin\Domain\Operation\Author\Update\Model\AuthorInterface;

interface UpdaterInterface
{
    public function update(AuthorInterface $author): void;
}
