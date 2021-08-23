<?php

declare(strict_types=1);

use Mono\Component\Page\Domain\Operation\View\Factory\Builder as ViewPageBuilder;
use Mono\Component\Page\Domain\Operation\View\Factory\BuilderInterface as ViewPageBuilderInterface;
use Mono\Component\Page\Domain\Operation\Create\Factory\Builder as CreatePageBuilder;
use Mono\Component\Page\Domain\Operation\Create\Factory\BuilderInterface as CreatePageBuilderInterface;
use Mono\Component\Page\Domain\Operation\Update\Factory\Builder as UpdatePageBuilder;
use Mono\Component\Page\Domain\Operation\Update\Factory\BuilderInterface as UpdatePageBuilderInterface;

use Mono\Component\Page\Infrastructure\Persistence\DBAL\Update\WriterRepository as UpdatePageWriterRepository;
use Mono\Component\Page\Domain\Operation\Update\Repository\WriterInterface as UpdatePageWriterInterface;
use Mono\Component\Page\Infrastructure\Persistence\DBAL\View\ReaderRepository as ViewPageReaderRepository;
use Mono\Component\Page\Domain\Operation\View\Repository\ReaderInterface as ViewPageReaderInterface;
use Mono\Component\Page\Infrastructure\Persistence\DBAL\Create\WriterRepository as CreatePageWriterRepository;
use Mono\Component\Page\Domain\Operation\Create\Repository\WriterInterface as CreatePageWriterInterface;

use Mono\Component\Article\Domain\Operation\Article\View\Factory\Builder as ViewArticleBuilder;
use Mono\Component\Article\Domain\Operation\Article\View\Factory\BuilderInterface as ViewArticleBuilderInterface;
use Mono\Component\Article\Domain\Operation\Article\Create\Factory\Builder as CreateArticleBuilder;
use Mono\Component\Article\Domain\Operation\Article\Create\Factory\BuilderInterface as CreateArticleBuilderInterface;
use Mono\Component\Article\Domain\Operation\Article\Update\Factory\Builder as UpdateArticleBuilder;
use Mono\Component\Article\Domain\Operation\Article\Update\Factory\BuilderInterface as UpdateArticleBuilderInterface;

use Mono\Component\Article\Infrastructure\Persistence\DBAL\Article\Update\WriterRepository as UpdateArticleWriterRepository;
use Mono\Component\Article\Domain\Operation\Article\Update\Repository\WriterInterface as UpdateArticleWriterInterface;
use Mono\Component\Article\Infrastructure\Persistence\DBAL\Article\View\ReaderRepository as ViewArticleReaderRepository;
use Mono\Component\Article\Domain\Operation\Article\View\Repository\ReaderInterface as ViewArticleReaderInterface;
use Mono\Component\Article\Infrastructure\Persistence\DBAL\Article\Create\WriterRepository as CreateArticleWriterRepository;
use Mono\Component\Article\Domain\Operation\Article\Create\Repository\WriterInterface as CreateArticleWriterInterface;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $containerConfigurator->import('services/');

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\', __DIR__.'/../src/App/')
        ->exclude([
            __DIR__ . '/../src/App/CMS/Infrastructure/DependencyInjection/',
            __DIR__.'/../src/Kernel.php'
        ]);

    $services->load('Mono\\Component\\AdminSecurity\\',
        __DIR__.'/../src/Mono/Component/AdminSecurity/src/');

    $services->load('App\\UI\\Admin\\Controller\\',
        __DIR__.'/../src/App/UI/Admin/Controller/**/Action.php')
        ->tag('controller.service_arguments');

    $services->load('App\\UI\\Front\\Controller\\',
        __DIR__.'/../src/App/UI/Front/Controller/**/Action.php')
        ->tag('controller.service_arguments');
};
