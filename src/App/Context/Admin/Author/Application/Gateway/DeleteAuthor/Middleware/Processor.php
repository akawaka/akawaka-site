<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Gateway\DeleteAuthor\Middleware;

use App\Context\Admin\Author\Application\Gateway\DeleteAuthor\Request;
use App\Context\Admin\Author\Application\Gateway\DeleteAuthor\Response;
use App\Context\Admin\Author\Application\Operation\Write\Delete\Command;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\CommandBusInterface;

final class Processor
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        ($this->commandBus)(new Command(
            $request->getIdentifier()
        ));

        return new Response();
    }
}
