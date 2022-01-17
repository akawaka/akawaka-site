<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\FindPageBySlug\Middleware;

use Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\FindPageBySlug\Response;
use Mono\Bundle\AoBundle\Admin\Page\Application\Operation\Read\FindBySlug\Query;
use Mono\Bundle\AoBundle\Admin\Page\Application\Gateway\FindPageBySlug\Request;
use Mono\Bundle\CoreBundle\Infrastructure\MessageBus\QueryBusInterface;

final class Processor
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        return new Response(($this->queryBus)(new Query(
            $request->getSlug()
        )));
    }
}
