<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\NoMultilineWhitespaceAroundDoubleArrowFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\Casing\NativeFunctionCasingFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use SlevomatCodingStandard\Sniffs\Commenting\ForbiddenAnnotationsSniff;
use SlevomatCodingStandard\Sniffs\Commenting\ForbiddenCommentsSniff;
use SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\GlobalKeywordSniff;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalClassFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\Comment\NoTrailingWhitespaceInCommentFixer;
use PhpCsFixer\Fixer\ConstantNotation\NativeConstantInvocationFixer;
use PhpCsFixer\Fixer\FunctionNotation\FopenFlagsFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\FunctionNotation\SingleLineThrowFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAnnotationWithoutDotFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use SlevomatCodingStandard\Sniffs\Whitespaces\DuplicateSpacesSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\StandaloneLineInMultilineArrayFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\CodingStandard\Fixer\Spacing\StandaloneLinePromotedPropertyFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/config/',
        __DIR__ . '/src/',
        __DIR__ . '/tests/',
    ]);

    $sets = [
        SetList::COMMON,
        SetList::CLEAN_CODE,
        SetList::SYMFONY,
        SetList::SYMFONY_RISKY,
        SetList::PSR_12,
    ];
    foreach ($sets as $set) {
        $containerConfigurator->import($set);
    }
    $parameters->set(Option::CACHE_DIRECTORY, __DIR__ . '/var/cache/ecs/main');
    $parameters->set(Option::SKIP, [
        SingleLineThrowFixer::class => null,
        NativeFunctionInvocationFixer::class => null,
        NativeConstantInvocationFixer::class => null,
        FopenFlagsFixer::class => null,
        ArrayIndentationFixer::class => null,
        ArrayOpenerAndCloserNewlineFixer::class => null,
        ArrayListItemNewlineFixer::class => null,
        StandaloneLineInMultilineArrayFixer::class => null,
        BinaryOperatorSpacesFixer::class => null,
        BracesFixer::class => null,
        StandaloneLinePromotedPropertyFixer::class => null,
        NoMultilineWhitespaceAroundDoubleArrowFixer::class => null,
        MethodArgumentSpaceFixer::class => null,
        NativeFunctionCasingFixer::class => null,
        ClassAttributesSeparationFixer::class => null,
        OrderedClassElementsFixer::class => null,
        FinalClassFixer::class => null,
        AssignmentInConditionSniff::class => null,
        LineLengthFixer::class => null,
        PhpdocAlignFixer::class => null,
        PhpdocSummaryFixer::class => null,
        PhpdocAnnotationWithoutDotFixer::class => null,
        PhpdocToCommentFixer::class => null,
        PhpdocVarWithoutNameFixer::class => null,
        ReturnAssignmentFixer::class => null,
        MethodChainingIndentationFixer::class => null,
        NotOperatorWithSuccessorSpaceFixer::class => null,
        PhpUnitStrictFixer::class => null,
    ]);

    $services = $containerConfigurator->services();
    $services->set(TrailingCommaInMultilineFixer::class);
    $services->set(GlobalKeywordSniff::class);
    $services->set(NoUnusedImportsFixer::class);
    $services->set(NoTrailingWhitespaceInCommentFixer::class);
    $services->set(NoEmptyPhpdocFixer::class);
    $services->set(ClassAttributesSeparationFixer::class);

    $services->set(NoSuperfluousPhpdocTagsFixer::class)
        ->call('configure', [['allow_mixed' => true]]);

    $services->set(UnusedVariableSniff::class)
        ->property('ignoreUnusedValuesWhenOnlyKeysAreUsedInForeach', true);

    $services->set(DuplicateSpacesSniff::class)
        ->property('ignoreSpacesInAnnotation', true);

    $services->set(GeneralPhpdocAnnotationRemoveFixer::class);
    $services->set(ForbiddenCommentsSniff::class)
        ->property('forbiddenCommentPatterns', [
            '/^Constructor\.$/',
            '/^[a-zA-Z]+ constructor\.$/',
            '/^Class [a-zA-Z]+$/',
            '/^\\\?Aio\\\([^\s]+)$/',
            '/^Created by PhpStorm\.$/',
            '/^User: (.*)$/',
            '/^Date: (.*)$/',
            '/^Time: (.*)$/',
        ]);
    $services->set(ForbiddenAnnotationsSniff::class)
        ->property('forbiddenAnnotations', ['@author', '@created', '@version', '@package', '@copyright', '@license']);
};