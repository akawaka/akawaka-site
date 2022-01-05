<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Domain\Update;

use Mono\Bundle\AoBundle\Admin\Author\Domain\Update\DataPersister\Model\AuthorInterface;

interface UpdaterInterface
{
    public function update(AuthorInterface $author): void;
}
