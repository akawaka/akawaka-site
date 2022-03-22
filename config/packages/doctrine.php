<?php

declare(strict_types=1);

use App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\AdminPasswordRecovery;
use App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\AdminUser;
use App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Article;
use App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Author;
use App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Category;
use App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Page;
use App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity\Space;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface;
use App\Shared\Domain\Model\ArticleInterface;
use App\Shared\Domain\Model\AuthorInterface;
use App\Shared\Domain\Model\CategoryInterface;
use App\Shared\Domain\Model\PageInterface;
use App\Shared\Domain\Model\SpaceInterface;
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
                    'dir' => '%kernel.project_dir%/src/App/Shared/Infrastructure/Persistence/Doctrine/ORM/Entity',
                    'prefix' => 'App\Shared\Infrastructure\Persistence\Doctrine\ORM\Entity',
                    'alias' => 'App',
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
