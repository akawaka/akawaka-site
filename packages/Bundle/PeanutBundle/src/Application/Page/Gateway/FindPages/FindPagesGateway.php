<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPages;

use Black\Bundle\CoreBundle\Application\GatewayException;
use Black\Bundle\PeanutBundle\Application\Page\Gateway\FindPages\Response\PageResponse;
use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPages;
use Black\Bundle\PeanutBundle\Application\Page\QueryHandler\HandleFindPages;

final class FindPagesGateway
{
    private Instrumentation $instrumentation;

    private HandleFindPages $queryHandler;

    public function __construct(
        Instrumentation $instrumentation,
        HandleFindPages $queryHandler
    ) {
        $this->instrumentation = $instrumentation;
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(FindPagesRequest $request): FindPagesResponse
    {
        $this->instrumentation->find($request);

        try {
            $pages = ($this->queryHandler)(new QueryFindPages(
                $request->getPage(),
            ));

            $response = new FindPagesResponse();
            foreach ($pages['results'] as $page) {
                $response->add(new PageResponse($page));
            }

            $this->instrumentation->found($response);

            return $response;
        } catch (\Exception $exception) {
            $this->instrumentation->notFound($request, $exception->getMessage());

            throw new GatewayException('Pages not found', $exception->getFile(), $exception->getMessage());
        }
    }
}
