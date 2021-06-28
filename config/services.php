<?php

declare(strict_types=1);

use App\CMS\Domain\Page\Operation\View\Factory\Builder as ViewPageBuilder;
use Mono\Component\Page\Domain\Operation\View\Factory\BuilderInterface as ViewPageBuilderInterface;
use App\CMS\Domain\Page\Operation\Create\Factory\Builder as CreatePageBuilder;
use Mono\Component\Page\Domain\Operation\Create\Factory\BuilderInterface as CreatePageBuilderInterface;
use App\CMS\Domain\Page\Operation\Update\Factory\Builder as UpdatePageBuilder;
use Mono\Component\Page\Domain\Operation\Update\Factory\BuilderInterface as UpdatePageBuilderInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use App\CMS\Infrastructure\Persistence\DBAL\Page\Update\WriterRepository as UpdatePageWriterRepository;
use Mono\Component\Page\Domain\Operation\Update\Repository\WriterInterface as UpdatePageWriterInterface;
use App\CMS\Infrastructure\Persistence\DBAL\Page\View\ReaderRepository as ViewPageReaderRepository;
use Mono\Component\Page\Domain\Operation\View\Repository\ReaderInterface as ViewPageReaderInterface;
use App\CMS\Infrastructure\Persistence\DBAL\Page\Create\WriterRepository as CreatePageWriterRepository;
use Mono\Component\Page\Domain\Operation\Create\Repository\WriterInterface as CreatePageWriterInterface;

use App\CMS\Domain\Article\Operation\View\Factory\Builder as ViewArticleBuilder;
use Mono\Component\Article\Domain\Operation\Article\View\Factory\BuilderInterface as ViewArticleBuilderInterface;
use App\CMS\Domain\Article\Operation\Create\Factory\Builder as CreateArticleBuilder;
use Mono\Component\Article\Domain\Operation\Article\Create\Factory\BuilderInterface as CreateArticleBuilderInterface;
use App\CMS\Domain\Article\Operation\Update\Factory\Builder as UpdateArticleBuilder;
use Mono\Component\Article\Domain\Operation\Article\Update\Factory\BuilderInterface as UpdateArticleBuilderInterface;
use App\CMS\Infrastructure\Persistence\DBAL\Article\Update\WriterRepository as UpdateArticleWriterRepository;
use Mono\Component\Article\Domain\Operation\Article\Update\Repository\WriterInterface as UpdateArticleWriterInterface;
use App\CMS\Infrastructure\Persistence\DBAL\Article\View\ReaderRepository as ViewArticleReaderRepository;
use Mono\Component\Article\Domain\Operation\Article\View\Repository\ReaderInterface as ViewArticleReaderInterface;
use App\CMS\Infrastructure\Persistence\DBAL\Article\Create\WriterRepository as CreateArticleWriterRepository;
use Mono\Component\Article\Domain\Operation\Article\Create\Repository\WriterInterface as CreateArticleWriterInterface;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $containerConfigurator->import('services/');

    $services->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->load('App\\', __DIR__.'/../src/App/')
        ->exclude([
            __DIR__ . '/../src/App/CMS/Infrastructure/DependencyInjection/',
            __DIR__.'/../src/Kernel.php'
        ])
    ;

    $services->load('Mono\\Component\\Page\\', __DIR__.'/../src/Mono/Component/Page/src/');
    $services->load('Mono\\Component\\Article\\', __DIR__.'/../src/Mono/Component/Article/src/');
    $services->load('Mono\\Component\\AdminSecurity\\', __DIR__.'/../src/Mono/Component/AdminSecurity/src/');

    $services->load('App\\UI\\Admin\\Controller\\', __DIR__.'/../src/App/UI/Admin/Controller/**/Action.php')
        ->tag('controller.service_arguments')
    ;

    $services->load('App\\UI\\Front\\Controller\\', __DIR__.'/../src/App/UI/Front/Controller/**/Action.php')
        ->tag('controller.service_arguments')
    ;

    $services->alias(CreatePageBuilderInterface::class, CreatePageBuilder::class);
    $services->alias(UpdatePageBuilderInterface::class, UpdatePageBuilder::class);
    $services->alias(UpdatePageWriterInterface::class, UpdatePageWriterRepository::class);
    $services->alias(ViewPageBuilderInterface::class, ViewPageBuilder::class);
    $services->alias(ViewPageReaderInterface::class, ViewPageReaderRepository::class);
    $services->alias(CreatePageWriterInterface::class, CreatePageWriterRepository::class);

    $services->alias(CreateArticleBuilderInterface::class, CreateArticleBuilder::class);
    $services->alias(UpdateArticleBuilderInterface::class, UpdateArticleBuilder::class);
    $services->alias(UpdateArticleWriterInterface::class, UpdateArticleWriterRepository::class);
    $services->alias(ViewArticleBuilderInterface::class, ViewArticleBuilder::class);
    $services->alias(ViewArticleReaderInterface::class, ViewArticleReaderRepository::class);
    $services->alias(CreateArticleWriterInterface::class, CreateArticleWriterRepository::class);
};
