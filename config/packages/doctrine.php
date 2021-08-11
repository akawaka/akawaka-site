<?php

declare(strict_types=1);

use Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping\Article;
use Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping\ArticleInterface;
use Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping\Category;
use Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping\CategoryInterface;
use Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping\Page;
use Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping\PageInterface;
use Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping\Space;
use Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping\SpaceInterface;
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
                CategoryInterface::class => Category::class,
                SpaceInterface::class => Space::class,
                PageInterface::class => Page::class,
                PasswordRecoveryInterface::class => AdminPasswordRecovery::class,
                UserInterface::class => AdminUser::class,
            ],
            'mappings' => [
                'CMS' => [
                    'is_bundle' => false,
                    'type' => 'attribute',
                    'dir' => '%kernel.project_dir%/src/Mono/Bundle/AoBundle/src/Infrastructure/Persistence/ORM/Mapping',
                    'prefix' => 'Mono\Bundle\AoBundle\Infrastructure\Persistence\ORM\Mapping',
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
