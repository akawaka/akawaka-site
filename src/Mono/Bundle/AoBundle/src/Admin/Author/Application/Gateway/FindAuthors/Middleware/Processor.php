<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\FindAuthors\Middleware;

use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\FindAuthors\Request;
use Mono\Bundle\AoBundle\Admin\Author\Application\Gateway\FindAuthors\Response;
use Mono\Bundle\AoBundle\Admin\Author\Application\Operation\Read\FindAll\Query;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
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
