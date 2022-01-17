<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\RecoverPassword;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Application\Gateway\GeneratePassword;
use App\UI\Admin\Controller\Routes;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Bundle\AkaBundle\Shared\Domain\PasswordGenerator;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private GeneratePassword\Gateway $updatePasswordGateway,
        private HtmlResponder $htmlResponder,
    ) {
    }

    #[Route(
        path: Routes::ADMIN_SECURITY_PASSWORD_RECOVER['path'],
        name: Routes::ADMIN_SECURITY_PASSWORD_RECOVER['name'],
        methods: ['GET']
    )]
    public function __invoke(string $token, Request $request): Response
    {
        $password = PasswordGenerator::generate();
        $this->updatePassword($token, $password);

        return ($this->htmlResponder)('Admin/Security/recover', [
            'password' => $password,
        ]);
    }

    private function updatePassword(string $token, string $password): GeneratePassword\Response
    {
        try {
            /** @var GeneratePassword\Response $response */
            return ($this->updatePasswordGateway)(GeneratePassword\Request::fromData([
                'token' => $token,
                'password' => $password,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }
}
