<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Gateway\UpdatePage;

use Black\Bundle\CoreBundle\Infrastructure\Instrumentation\PsrInstrumentation;
use Psr\Log\LoggerInterface;

final class Instrumentation
{
    private LoggerInterface $logger;

    public function __construct(PsrInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function update(UpdatePageRequest $request): void
    {
        $this->logger->info('page.update_page', $request->data());
    }

    public function updated(UpdatePageResponse $response): void
    {
        $this->logger->info('page.update_page_success', $response->data());
    }

    public function notUpdated(UpdatePageRequest $request, string $reason): void
    {
        $this->logger->error('page.update_page_error', array_merge($request->data(),
            ['reason' => $reason]
        ));
    }
}
