<?php

declare(strict_types=1);

use Mono\Bundle\AkaBundle\Context\Security\User\Infrastructure\Authentication\LoginFormAuthenticator;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('security', [
        'enable_authenticator_manager' => true,
        'providers' => [
            'admin' => [
                'entity' => [
                    'class' => UserInterface::class,
                    'property' => 'id'
                ]
            ]
        ],
        'password_hashers' => [
            UserInterface::class => [
                'algorithm' => 'auto'
            ]
        ],
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false
            ],
            'admin' => [
                'custom_authenticators' => [LoginFormAuthenticator::class],
                'lazy' => true,
                'remember_me' => [
                    'secret' => '%kernel.secret%',
                    'lifetime' => 604800,
                    'path' => '/admin'
                ],
                'logout' => [
                    'path' => '/admin/logout',
                    'target' => '/admin/login'
                ]
            ]
        ],
        'access_control' => [
            ['path' => '^/admin/login', 'roles' => 'PUBLIC_ACCESS'],
            ['path' => '^/admin/reset-password', 'roles' => 'PUBLIC_ACCESS'],
            ['path' => '^/admin/recover-password', 'roles' => 'PUBLIC_ACCESS'],
            ['path' => '^/admin', 'roles' => 'ROLE_ADMIN']
        ]
    ]);
};
