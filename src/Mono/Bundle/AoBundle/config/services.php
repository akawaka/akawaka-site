<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

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

return static function (ContainerConfigurator $configurator) {
    $configurator->import('services/*');
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->load('Mono\\Bundle\\AoBundle\\', '../src/*');

    $services->load('Mono\\Component\\Page\\', __DIR__.'/../../../Component/Page/src/');
    $services->load('Mono\\Component\\Article\\', __DIR__.'/../../../Component/Article/src/');

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
