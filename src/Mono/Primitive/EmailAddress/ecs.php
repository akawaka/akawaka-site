<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PARALLEL, true);

    $parameters->set(Option::PATHS, [
        __DIR__.'/src',
        __DIR__.'/tests',
    ]);

    $parameters->set(Option::SKIP, [
        __DIR__.'/tests/Application',
        PhpdocAlignFixer::class,
    ]);

    $services = $containerConfigurator->services();
    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]])
    ;

    // run and fix, one by one
    $containerConfigurator->import(SetList::SYMFONY);
    $containerConfigurator->import(SetList::SYMFONY_RISKY);
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::PHP_CS_FIXER_RISKY);
};
