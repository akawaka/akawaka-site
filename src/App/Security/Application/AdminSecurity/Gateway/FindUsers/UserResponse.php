<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Gateway\FindUsers;

use App\Security\Application\AdminSecurity\Gateway\UserResponse as UserReponseTrait;
use Mono\Component\Core\Application\Gateway\GatewayResponse;

final class UserResponse implements GatewayResponse
{
    use UserReponseTrait;
}
