<?php

declare(strict_types=1);

namespace App\Security\Infrastructure\Authenticator\Admin;

use App\Security\Application\AdminSecurity\Gateway\FindUserByUsernameOrEmail;
use App\UI\Admin\Controller\Routes;
use Mono\Bundle\CoreBundle\Application\Gateway\GatewayException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

final class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    public function __construct(
        private FindUserByUsernameOrEmail\Gateway $gateway,
        private RouterInterface $router,
    ) {
    }

    public function authenticate(Request $request): PassportInterface
    {
        $credentials = $this->getCredentials($request);

        return new Passport(
            new UserBadge($credentials['username'], function ($userIdentifier) {
                return ($this->process($userIdentifier))->getUser();
            }),
            new PasswordCredentials($credentials['password']),
            [
                new CsrfTokenBadge('authenticate', $credentials['csrf_token']),
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse($this->router->generate(Routes::ADMIN_LOGIN['name']));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->router->generate(Routes::ADMIN_LOGIN['name']);
    }

    private function process(string $username): FindUserByUsernameOrEmail\Response
    {
        try {
            return ($this->gateway)(FindUserByUsernameOrEmail\Request::fromData([
                'usernameOrEmail' => $username,
            ]));
        } catch (GatewayException $exception) {
            throw new HttpException(500, $exception->getMessage());
        }
    }

    private function getCredentials(Request $request)
    {
        $credentials = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['username']
        );

        return $credentials;
    }
}
