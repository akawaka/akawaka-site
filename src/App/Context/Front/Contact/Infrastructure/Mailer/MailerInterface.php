<?php

declare(strict_types=1);

namespace App\Context\Front\Contact\Infrastructure\Mailer;

use Symfony\Component\Mime\Address;

interface MailerInterface
{
    public function send(Email $email): bool;

    public function getSender(): Address;
}
