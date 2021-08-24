<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthors\Middleware;

use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthors\Request;
use Mono\Bundle\AoBundle\Admin\Application\Author\Gateway\FindAuthors\Response;
use Mono\Bundle\AoBundle\Admin\Application\Author\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class ProcessorMiddleware
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $authors = ($this->queryBus)(new Query());

        $response = new Response();
        foreach ($authors as $author) {
            $response->add($author);
        }

        return $response;
    }
}
