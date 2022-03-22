<?php

declare(strict_types=1);

namespace App\Context\Admin\Space\Application\Operation\Read\Browse;

use App\Context\Admin\Space\Domain\Browse\BrowserInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class Handler implements MessageHandlerInterface
{
    public function __construct(
        private BrowserInterface $browser
    ) {
    }

    public function __invoke(Query $query): array
    {
        return $this->browser->browse();
    }
}
