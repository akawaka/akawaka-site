<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\BrowseAuthors\Middleware;

use Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\BrowseAuthors\Request;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Gateway\BrowseAuthors\Response;
use Mono\Bundle\AoBundle\Context\CRUD\Author\Application\Operation\Read\Browse\Query;
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
