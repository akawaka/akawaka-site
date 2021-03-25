<?php

declare(strict_types=1);

namespace Black\Bundle\CoreBundle\Infrastructure\Instrumentation;

use Psr\Log\LoggerInterface;

class PsrInstrumentation
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}
