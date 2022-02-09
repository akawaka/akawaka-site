<?php

declare(strict_types=1);

use Mono\Bundle\AkaBundle\Shared\Domain\Model\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface;
use App\Infrastructure\Persistence\Doctrine\ORM\Entity\AdminPasswordRecovery;
use App\Infrastructure\Persistence\Doctrine\ORM\Entity\AdminUser;
use Mono\Bundle\AoBundle\Shared\Domain\Model\ArticleInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Model\AuthorInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Model\CategoryInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Model\PageInterface;
use Mono\Bundle\AoBundle\Shared\Domain\Model\SpaceInterface;
use App\Infrastructure\Persistence\Doctrine\ORM\Entity\Article;
use App\Infrastructure\Persistence\Doctrine\ORM\Entity\Author;
use App\Infrastructure\Persistence\Doctrine\ORM\Entity\Category;
use App\Infrastructure\Persistence\Doctrine\ORM\Entity\Page;
use App\Infrastructure\Persistence\Doctrine\ORM\Entity\Space;
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
                'App' => [
                    'is_bundle' => false,
                    'type' => 'attribute',
                    'dir' => '%kernel.project_dir%/src/App/Infrastructure/Persistence/Doctrine/ORM/Entity',
                    'prefix' => 'App\Infrastructure\Persistence\Doctrine\ORM\Entity',
                    'alias' => 'App',
                ],
                'Ao' => [
                    'is_bundle' => false,
                    'type' => 'attribute',
                    'dir' => '%kernel.project_dir%/mono/Bundle/AoBundle/src/Shared/Infrastructure/Persistence/Doctrine/ORM/Entity',
                    'prefix' => 'Mono\Bundle\AoBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity',
                    'alias' => 'Ao',
                ],
                'Aka' => [
                    'is_bundle' => false,
                    'type' => 'attribute',
                    'dir' => '%kernel.project_dir%/mono/Bundle/AkaBundle/src/Shared/Infrastructure/Persistence/Doctrine/ORM/Entity',
                    'prefix' => 'Mono\Bundle\AkaBundle\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity',
                    'alias' => 'Aka',
                ],
            ],
        ],
    ]);
};
