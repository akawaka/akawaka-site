<?php

declare(strict_types=1);

namespace App\Context\Admin\Author\Application\Gateway\BrowseAuthors\Middleware;

use App\Context\Admin\Author\Application\Gateway\BrowseAuthors\Request;
use App\Context\Admin\Author\Application\Gateway\BrowseAuthors\Response;
use App\Context\Admin\Author\Application\Operation\Read\Browse\Query;
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
