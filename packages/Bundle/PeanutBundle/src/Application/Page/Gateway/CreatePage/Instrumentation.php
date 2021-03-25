<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\CreatePage;

use Black\Bundle\CoreBundle\Infrastructure\Instrumentation\PsrInstrumentation;
use Psr\Log\LoggerInterface;

final class Instrumentation
{
    private LoggerInterface $logger;

    public function __construct(PsrInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function create(CreatePageRequest $request): void
    {
        $this->logger->info('page.create_page', $request->data());
    }

    public function created(CreatePageResponse $response): void
    {
        $this->logger->info('page.create_page_success', $response->data());
    }

    public function notCreated(CreatePageRequest $request, string $reason): void
    {
        $this->logger->error('page.create_page_error', array_merge($request->data(),
            ['reason' => $reason]
        ));
    }
}
