<?php

declare(strict_types=1);

use App\CMS\Domain\Entity\Article;
use App\CMS\Domain\Entity\Category;
use App\CMS\Domain\Entity\Space;
use App\CMS\Domain\Entity\Page;
use App\Security\Domain\Entity\AdminPasswordRecovery;
use App\Security\Domain\Entity\AdminUser;
use Mono\Component\AdminSecurity\Domain\Entity\PasswordRecoveryInterface;
use Mono\Component\AdminSecurity\Domain\Entity\User;
use Mono\Component\AdminSecurity\Domain\Entity\UserInterface;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Space\Domain\Entity\SpaceInterface;
use Mono\Component\Page\Domain\Entity\PageInterface;
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
                CategoryInterface::class => Category::class,
                SpaceInterface::class => Space::class,
                PageInterface::class => Page::class,
                PasswordRecoveryInterface::class => AdminPasswordRecovery::class,
                UserInterface::class => AdminUser::class,
            ],
            'mappings' => [
                'CMS' => [
                    'is_bundle' => false,
                    'type' => 'xml',
                    'dir' => '%kernel.project_dir%/config/doctrine/cms/entity',
                    'prefix' => 'App\CMS\Domain\Entity',
                    'alias' => 'CMS'
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
