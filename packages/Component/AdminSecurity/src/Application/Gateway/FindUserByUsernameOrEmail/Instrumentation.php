<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\FindUserByUsernameOrEmail;

use Mono\Component\Core\Infrastructure\Instrumentation\LoggerInstrumentation;
use Psr\Log\LoggerInterface;

final class Instrumentation
{
    private LoggerInterface $logger;

    public function __construct(LoggerInstrumentation $instrumentation)
    {
        $this->logger = $instrumentation->getLogger();
    }

    public function start(Request $request): void
    {
        $this->logger->info('user.find_by_username_or_email', $request->data());
    }

    public function success(Response $response): void
    {
        $this->logger->info('user.find_by_username_or_email.success', $response->data());
    }

    public function error(Request $request, string $reason): void
    {
        $this->logger->error('user.find_by_username_or_email.error', array_merge(
            $request->data(),
            [' reason' => $reason]
        ));
    }
}
