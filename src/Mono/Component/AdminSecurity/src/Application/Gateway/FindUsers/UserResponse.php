<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Gateway\FindUsers;

use Mono\Component\AdminSecurity\Application\Gateway\UserResponse as UserReponseTrait;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class UserResponse implements GatewayResponse
{
    use UserReponseTrait;
}
