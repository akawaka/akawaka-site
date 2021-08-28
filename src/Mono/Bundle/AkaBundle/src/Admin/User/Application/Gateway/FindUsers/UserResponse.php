<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\FindUsers;

use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UserResponse as UserReponseTrait;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class UserResponse implements GatewayResponse
{
    use UserReponseTrait;
}
