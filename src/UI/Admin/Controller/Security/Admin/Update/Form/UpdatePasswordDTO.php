<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\Admin\Update\Form;

use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

final class UpdatePasswordDTO
{
    public function __construct(
        #[UserPassword(
            message: 'Wrong value for your current password',
        )]
        private string $oldPassword,
        private string $newPassword,
    ) {
    }

    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function data(): array
    {
        return [
            'oldPassword' => $this->getOldPassword(),
            'newPassword' => $this->getNewPassword(),
        ];
    }
}
