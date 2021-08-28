<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UpdatePassword;

use Mono\Bundle\AkaBundle\Admin\User\Application\Gateway\UserResponse;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayResponse;

final class Response implements GatewayResponse
{
    use UserResponse;
}
