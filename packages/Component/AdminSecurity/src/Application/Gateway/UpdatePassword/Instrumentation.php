<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\UpdatePassword;

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
        $this->logger->info('admin_security.change_password', $request->data());
    }

    public function success(Response $response): void
    {
        $this->logger->info('admin_security.change_password.success', $response->data());
    }

    public function error(Request $request, string $reason): void
    {
        unset($request->data()['password']);

        $this->logger->error('admin_security.change_password.error', array_merge(
            $request->data(),
            [' reason' => $reason]
        ));
    }
}
