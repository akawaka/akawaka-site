<?php

declare(strict_types=1);

use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\Article;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\ArticleInterface;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\Author;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\AuthorInterface;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\Category;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\CategoryInterface;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\Page;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\PageInterface;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\Space;
use Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping\SpaceInterface;
use App\Security\Domain\Entity\AdminPasswordRecovery;
use App\Security\Domain\Entity\AdminUser;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'dbal' => [
            'url' => '%env(resolve:DATABASE_URL)%'
        ],
        'orm' => [
            'auto_generate_proxy_classes' => true,
            'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
            'auto_mapping' => true,
            'resolve_target_entities' => [
                ArticleInterface::class => Article::class,
                AuthorInterface::class => Author::class,
                CategoryInterface::class => Category::class,
                SpaceInterface::class => Space::class,
                PageInterface::class => Page::class,
                PasswordRecoveryInterface::class => AdminPasswordRecovery::class,
                UserInterface::class => AdminUser::class,
            ],
            'mappings' => [
                'Ao' => [
                    'is_bundle' => false,
                    'type' => 'attribute',
                    'dir' => '%kernel.project_dir%/src/Mono/Bundle/AoBundle/src/Shared/Infrastructure/Doctrine/Mapping',
                    'prefix' => 'Mono\Bundle\AoBundle\Shared\Infrastructure\Doctrine\Mapping',
                    'alias' => 'Ao'
                ],
                'Security' => [
                    'is_bundle' => false,
                    'type' => 'xml',
                    'dir' => '%kernel.project_dir%/config/doctrine/security/entity',
                    'prefix' => 'App\Security\Domain\Entity',
                    'alias' => 'Security'
                ]
            ]
        ]
    ]);
};
