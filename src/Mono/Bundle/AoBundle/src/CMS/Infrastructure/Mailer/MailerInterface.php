<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Mailer;

use Symfony\Component\Mime\Address;

interface MailerInterface
{
    public function send(Email $email): bool;

    public function getSender(): Address;
}
