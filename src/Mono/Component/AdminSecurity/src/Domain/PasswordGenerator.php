<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Domain;

final class PasswordGenerator
{
    public static function generate(): string
    {
        return bin2hex(random_bytes(8));
    }
}