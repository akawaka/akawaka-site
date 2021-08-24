<?php

declare(strict_types=1);

namespace App\UI\Admin\Controller\Security\RecoverPassword;

use App\Security\Application\AdminSecurity\Gateway\FindPasswordRecoveryByToken;
use App\Security\Application\AdminSecurity\Gateway\UpdatePassword;
use App\UI\Admin\Controller\Routes;
use Mono\Bundle\CoreBundle\UI\Responder\HtmlResponder;
use Mono\Component\AdminSecurity\Domain\PasswordGenerator;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

final class Action
{
    public function __construct(
        private FindPasswordRecoveryByToken\Gateway $recoveryGateway,
        private UpdatePassword\Gateway $updatePasswordGateway,
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
        $recovery = $this->find($token);

        $password = PasswordGenerator::generate();
        $this->updatePassword($recovery, $password);

        return ($this->htmlResponder)('Admin/Security/recover', [
            'password' => $password,
            'username' => $recovery->data()['user']['username'],
        ]);
    }

    private function find($token): FindPasswordRecoveryByToken\Response
    {
        try {
            $result = ($this->recoveryGateway)(FindPasswordRecoveryByToken\Request::fromData([
                'token' => $token,
            ]));
        } catch (GatewayException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }

        return $result;
    }

    private function updatePassword(FindPasswordRecoveryByToken\Response $response, string $password): UpdatePassword\Response
    {
        try {
            return ($this->updatePasswordGateway)(UpdatePassword\Request::fromData([
                'identifier' => $response->data()['user']['identifier'],
                'password' => $password,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }
}
